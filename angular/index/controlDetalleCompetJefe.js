angular.module("index")
        .controller("controlDetalleCompetJefe", ['$scope', 'factoryCompetenciasColab', 'userService', '$routeParams', 'modalService', function ($scope, factoryCompetenciasColab, userService, $routeParams, modalService) {

                $scope.competencias = "";
                $scope.colaborador = "";

                $scope.init = function () {
                    $scope.cargar();
                    $scope.cargarColaborador();
                };


                $scope.cargarColaborador = function () {
                    userService.loadAllUser($routeParams.id)
                            .success(function (data, status, headers, config) {
                                $scope.colaborador = data.usuario[0].nombre + " " + data.usuario[0].apellido1 + " " + data.usuario[0].apellido2;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };


                $scope.cargar = function () {
                    var colab = {id: $routeParams.id}
                    factoryCompetenciasColab.cargarDetalleCompetenciasJefe(colab)
                            .success(function (data, status, headers, config) {
                                $scope.competencias = data.competencias;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };


            }]);



