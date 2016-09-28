angular.module("index")
        .controller("controlEmpresa", function ($scope, factoryEmpresa, ShareDataService) {

            $scope.empresas = [];
            $scope.empresa = 0;
            $scope.empresaNombre = "";

            $scope.selectEmpresa = function (msg) {
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
            $scope.eliminar = function (id) {
                factoryEmpresa.eliminarEmpresa(id)
                        .success(function (data, status, headers, config) {
                            $scope.cargar();
                        })
                        .error(function (data, status, headers, config) {
                            alert("failure message: " + JSON.stringify(data));
                        });
            };
            $scope.agregar = function () {
                var nombre = $scope.empresaNombre;
                factoryEmpresa.agregarEmpresa(nombre)
                        .success(function (data, status, headers, config) {
                            $scope.empresaNombre = "";
                            $scope.cargar();
                        })
                        .error(function (data, status, headers, config) {
                            alert("failure message: " + JSON.stringify(data));
                        });
            };
        })
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



