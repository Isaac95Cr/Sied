angular.module("index")
        .controller("controlDetalleMetasJefe", ['$scope', 'factoryMeta', 'userService', '$routeParams', 'modalService', function ($scope, factoryMeta, userService, $routeParams, modalService) {

                $scope.metasUser = [];
                $scope.tiene_Metas = false;
                $scope.colaborador = "";

                $scope.init = function () {
                    $scope.cargar();
                    $scope.cargarColaborador();
                };


                $scope.cargar = function () {
                    var obj = {id: $routeParams.id}
                    factoryMeta.cargarMetasUser(obj)
                            .success(function (data, status, headers, config) {
                                $scope.metasUser = data.metas;
                                if ($scope.metasUser.length !== 0)
                                    $scope.tiene_Metas = true;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
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
                
                
            }]);

