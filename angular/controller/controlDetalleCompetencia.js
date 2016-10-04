angular.module("index")
        .controller("controlDetalleCompetencia", ['$scope', 'factoryDetalleCompetencia', 'modalService', function ($scope, factoryDetalleCompetencia, modalService) {

                $scope.detallecompetencias = [];
                $scope.detallecompetencia = 0;

                $scope.selectPerfil = function (msg) {

                };

                $scope.init = function () {
                    
                };

                $scope.cargar = function () {
                    factoryDetalleCompetencia.cargarDetalle()
                            .success(function (data, status, headers, config) {
                                $scope.competencias = data.competencia;

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

                    factoryDetalleCompetencia.eliminarDetalle(id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>")
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.agregar = function () {
                    factoryDetalleCompetencia.agregarDetalle(descripcion,competencia)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");

                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
            }])
        .factory("factoryDetalleCompetencia", function ($http) {
            var competencia = {};

            competencia.cargarDetalle = function () {
                return $http.get('/Sied/services/get-competencia.php');
            };

            competencia.agregarDetalle = function (descripcion,competencia) {
                var obj = {
                    descripcion: descripcion,
                    competencia:competencia
                };
                return $http.post('/Sied/services/add-competencia.php', obj);
            };

            competencia.eliminarDetalle = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/del-competencia.php', obj);
            };
            return competencia;
        });