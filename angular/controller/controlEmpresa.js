angular.module("index")
        .controller("controlEmpresa", ['$scope', 'factoryEmpresa', 'ShareDataService', 'modalService', function ($scope, factoryEmpresa, ShareDataService, modalService) {

                $scope.empresas = [];
                $scope.empresa = 0;
                $scope.empresaAdd = "";
                $scope.empresaEdit = "";

                $scope.selectEmpresa = function (msg) {
                    $scope.empresa = msg;
                    ShareDataService.prepForBroadcast(msg);
                };
                $scope.init = function () {
                    $scope.cargar();
                };
                $scope.cargar = function () {
                    factoryEmpresa.cargarEmpresas()
                            .success(function (data, status, headers, config) {
                                $scope.empresas = data.empresa;
                                $scope.selectEmpresa(data.empresa[0]);
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
                    factoryEmpresa.eliminarEmpresa(id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.modalModificar = function (empresa) {
                    $scope.selectEmpresa(empresa);
                    $scope.empresaEdit = empresa.nombre;
                    modalService.open("#modalEmpresaEdit");
                };
                $scope.modificar = function () {
                    var nombre = $scope.empresaEdit;
                    var id = $scope.empresa.id;
                    factoryEmpresa.modificarEmpresa(nombre, id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.empresaEdit = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.agregar = function () {
                    var nombre = $scope.empresaAdd;
                    factoryEmpresa.agregarEmpresa(nombre)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.empresaAdd = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
            }])
        .factory("factoryEmpresa", function ($http) {
            var empresa = {};

            empresa.cargarEmpresas = function () {
                return $http.get('/Sied/services/get-empresa.php');
            };

            empresa.agregarEmpresa = function (nombre) {
                var obj = {
                    nombre: nombre
                };
                return $http.post('/Sied/services/add-empresa.php', obj);
            };
            empresa.modificarEmpresa = function (nombre, id) {
                var obj = {
                    id: id,
                    nombre: nombre
                };
                return $http.post('/Sied/services/set-empresa.php', obj);
            };

            empresa.eliminarEmpresa = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/del-empresa.php', obj);
            };
            return empresa;
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
        


