angular.module("index")
        .controller("controlPerfilCompetencia", ['$scope', 'factoryperfilCompetencia', 'modalService', function ($scope, factoryperfilCompetencia, modalService) {

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
                    factoryperfilCompetencia.cargarPerfilesCompetencia()
                            .success(function (data, status, headers, config) {
                                $scope.perfiles = data.perfiles;
                                $scope.perfil = data.perfiles[0];
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
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

                    factoryperfilCompetencia.eliminarPerfilCompetencia(id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>")
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.modalModificar = function (perfil) {
                    $scope.selectPerfil(perfil);
                    $scope.perfilEdit = perfil.nombre;
                    modalService.open("#modalPerfilEdit");
                };
                $scope.modificar = function () {
                    var nombre = $scope.perfilEdit;
                    var id = $scope.perfil.id;
                    factoryperfilCompetencia.modificarPerfilCompetencia(nombre, id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.perfilEdit = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.agregar = function () {
                    var nombre = $scope.perfilAdd;
                    factoryperfilCompetencia.agregarPerfilCompetencia(nombre)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.perfilNombre = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
            }])
        .factory("factoryperfilCompetencia", function ($http) {
            var perfil = {};

            perfil.cargarPerfilesCompetencia = function () {
                return $http.get('/Sied/services/competencia/get-perfilCompetencia.php');
            };

            perfil.cargarPerfilCompetencia = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/competencia/get-perfilCompetencia.php', obj);
            };
            perfil.modificarPerfilCompetencia = function (nombre, id) {
                var obj = {
                    nombre: nombre,
                    id: id
                };
                return $http.post('/Sied/services/competencia/set-perfilCompetencia.php', obj);
            };

            perfil.agregarPerfilCompetencia = function (nombre) {
                var obj = {
                    nombre: nombre
                };
                return $http.post('/Sied/services/competencia/add-perfilCompetencia.php', obj);
            };

            perfil.eliminarPerfilCompetencia = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/competencia/del-perfilCompetencia.php', obj);
            };
            return perfil;
        })
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