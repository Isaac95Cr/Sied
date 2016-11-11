angular.module("index")
        .controller("controlDetalleCompetJefe", ['$scope', 'factoryCompetenciasColab', 'userService', '$routeParams', 'modalService', function ($scope, factoryCompetenciasColab, userService, $routeParams, modalService) {

                $scope.competencias = "";
                $scope.colaborador = "";

                $scope.init = function () {
                    $scope.cargar();
                    $scope.cargarColaborador();
                };


                $scope.cargarColaborador = function () {
                    var colab = {id: $routeParams.id}
                    userService.cargarUsuario(colab)
                            .success(function (data, status, headers, config) {
                                $scope.colaborador = data.usuarios[0].nombre + " " + data.usuarios[0].apellido1 + " " + data.usuarios[0].apellido2;
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



