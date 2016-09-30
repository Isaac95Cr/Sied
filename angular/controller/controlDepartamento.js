angular.module("index")
        .controller("controlDepartamento",['$scope', 'factoryDepartamento','ShareDataService','modalService',function ($scope, factoryDepartamento, ShareDataService,modalService) {

            $scope.departamentos = [];
            $scope.departamentosfiltrados = [];
            $scope.empresa = {};
            $scope.departamentoNombre = "";

            filtro = function (departamento) {
                return departamento.empresa == $scope.empresa.id;
            };
            filtrarDepartamentos = function () {
                $scope.departamentosfiltrados = $scope.departamentos.filter(filtro);
            };
            $scope.init = function () {
                $scope.cargar();
            };
            $scope.cargar = function () {
                factoryDepartamento.cargarDepartamentos()
                        .success(function (data, status, headers, config) {
                            $scope.departamentos = data.departamento;
                            filtrarDepartamentos();
                        })
                        .error(function (data, status, headers, config) {
                            alert("failure message: " + JSON.stringify(headers));
                        });
            };

            $scope.eliminar = function (id) {
                factoryDepartamento.eliminarDepartamento(id)
                        .success(function (data, status, headers, config) {
                            $scope.cargar();
                        })
                        .error(function (data, status, headers, config) {
                            alert("failure message: " + JSON.stringify(data));
                        });
            };
            $scope.agregar = function () {
                var nombre = $scope.departamentoNombre;
                var empresa = $scope.empresa.id;
                factoryDepartamento.agregarDepartamento(nombre, empresa)
                        .success(function (data, status, headers, config) {
                            $scope.departamentoNombre = "";
                            $scope.cargar();
                        })
                        .error(function (data, status, headers, config) {
                            alert("failure message: " + JSON.stringify(data));
                        });

            };

            $scope.$on('handleBroadcast', function () {
                $scope.empresa = ShareDataService.msg;
                filtrarDepartamentos();
            });



        }])
        .factory("factoryDepartamento", function ($http) {
            var departamentos = {};

            departamentos.cargarDepartamentos = function () {
                return $http.get('/Sied/services/get-departamento.php');
            };
            departamentos.agregarDepartamento = function (nombre, empresa) {
                var obj = {
                    nombre: nombre,
                    empresa: empresa
                };
                return $http.post('/Sied/services/add-departamento.php', obj);
            };

            departamentos.eliminarDepartamento = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/del-departamento.php', obj);
            };

            return departamentos;
        });

