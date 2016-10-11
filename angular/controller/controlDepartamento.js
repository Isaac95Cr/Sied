angular.module("index")
        .controller("controlDepartamento", ['$scope', 'factoryDepartamento', 'ShareDataService', 'modalService', function ($scope, factoryDepartamento, ShareDataService, modalService) {

                $scope.departamentos = [];
                $scope.departamentosfiltrados = [];
                $scope.empresa = {};
                $scope.departamentoAdd = "";
                $scope.departamentoEdit = "";
                $scope.departamento = {};

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
                $scope.confirmar = function (id) {
                    modalService.modalYesNo("Confirmacion", "<p>" + "¿Esta seguro de realizar la accion?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.eliminar(id);
                            });
                };
                $scope.eliminar = function (id) {
                    factoryDepartamento.eliminarDepartamento(id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.modalModificar = function (departamento) {
                    $scope.departamento = departamento;
                    $scope.departamentoEdit = departamento.nombre;
                    modalService.open("#modalDepartamentoEdit");
                };
                $scope.modificar = function () {
                    var nombre = $scope.departamentoEdit;
                    var id = $scope.departamento.id;
                    factoryDepartamento.modificarDepartamento(nombre, id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.departamentoEdit = "";
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
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
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
            departamentos.modificarDepartamento = function (nombre, id) {
                var obj = {
                    id: id,
                    nombre: nombre
                };
                return $http.post('/Sied/services/set-departamento.php', obj);
            };

            departamentos.eliminarDepartamento = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/del-departamento.php', obj);
            };

            return departamentos;
        });

