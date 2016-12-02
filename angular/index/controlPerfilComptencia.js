angular.module("index")
        .controller("controlPerfilCompetencia", ['$scope', 'modalService', 'apiConnector', function ($scope, modalService, apiConnector) {

                $scope.perfiles = [];
                $scope.perfil = 0;
                $scope.perfilAdd = "";
                $scope.perfilEdit = "";

                $scope.selectPerfil = function (perfil) {
                    $scope.perfil = perfil;
                };

                $scope.init = function () {
                    $scope.cargar();
                };

                $scope.cargar = function () {
                    apiConnector.get("api/perfilCompetencias/all").then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.perfiles = res.data;
                            $scope.perfil = res.data[0];
                        }
                    });
                };
                $scope.confirmar = function (id) {
                    modalService.modalYesNo("Confirmacion", "<p>" + "¿Esta seguro de realizar la accion?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.eliminar(id);
                            });
                };
                $scope.eliminar = function (id) {
                    apiConnector.post("api/perfilCompetencias/del", {id: id}).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Eliminar Perfil", "<p>" + res.message + "</p>")
                            $scope.cargar();
                        }
                    });
                };
                $scope.modalModificar = function (perfil) {
                    $scope.selectPerfil(perfil);
                    $scope.perfilEdit = perfil.nombre;
                    modalService.open("#modalPerfilEdit");
                };
                $scope.modificar = function () {
                    var obj = {
                        nombre: $scope.perfilEdit,
                        id: $scope.perfil.id
                    };
                    apiConnector.put("api/perfilCompetencias/set", obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Modificar Perfil", "<p>" + res.message + "</p>");
                            $scope.perfilEdit = undefined;
                            $scope.cargar();
                        }
                    });
                };
                $scope.agregar = function () {
                    var nombre = $scope.perfilAdd;
                    apiConnector.post("api/perfilCompetencias/add", {nombre: nombre}).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Agregar Competencia", "<p>" + res.message + "</p>");
                            $scope.perfilNombre = undefined;
                            $scope.cargar();
                        }
                    });
                };
            }])
        .factory('ShareDataService', function ($rootScope) {
            var sharedService = {};
            sharedService.msg = {};
            sharedService.prepForBroadcast = function (msg) {
                this.msg = msg;
                this.broadcastItem();
            };

            sharedService.broadcastItem = function () {
                $rootScope.$broadcast('handleBroadcast');
            };

            return sharedService;
        });