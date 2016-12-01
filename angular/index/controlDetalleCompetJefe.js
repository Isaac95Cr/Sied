angular.module("index")
        .controller("controlDetalleCompetJefe", ['$scope', 'factoryCompetenciasColab', 'userService', '$routeParams', 'modalService', 'servicioCompetColab', 
                            function ($scope, factoryCompetenciasColab, userService, $routeParams, modalService, servicioCompetColab) {

                $scope.competencias = "";
                $scope.colaborador = "";

                $scope.perfilCompet = "";  // aqui se guarda el id del perfil de competencia del usuario.
                $scope.userOnline = "";
                $scope.nombrePerfil = "";  // aquí se almacena el nombre del perfil de competencia

                $scope.init = function () {
                    $scope.cargar();
                    $scope.cargarColaborador();
                    $scope.getPerfilCompetencia();
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



                $scope.getPerfilCompetencia = function () {
                    var colab = {id: $routeParams.id}
                    return factoryCompetenciasColab.getPerfilCompetUser(colab)
                            .success(function (data, status, headers, config) {
                                $scope.perfilCompet = data.perfil.id;
                                $scope.nombrePerfil = data.perfil.nombre;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });

                };


            }]);



