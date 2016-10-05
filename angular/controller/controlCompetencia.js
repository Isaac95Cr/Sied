angular.module("index")
        .controller("controlCompetencia", ['$scope', 'factoryCompetencia', 'modalService', function ($scope, factoryCompetencia, modalService) {

                $scope.competencias = [];
                $scope.competencia = 0;

                $scope.selectPerfil = function (msg) {

                };

                $scope.init = function () {
                    
                };

                $scope.cargar = function () {
                    factoryCompetencia.cargarCompetencia()
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

                    factoryCompetencia.eliminarCompetencia(id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>")
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.agregar = function () {
                    factoryCompetencia.agregarCompetencia(titulo,descripcion,peso,perfil)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");

                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
            }]);
        