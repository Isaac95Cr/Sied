angular.module('index')
        .controller('controlPerfil', ['$scope','userService', 'sessionService', function ($scope, userService, sessionService) {
                $scope.user = {};
                $scope.init = function () {
                    $scope.cargar();
                };
                $scope.cargar = function () {
                    userService.cargarUsuario(sessionService.getUsuario().id)
                            .success(function (data, status, headers, config) {
                                $scope.setUser(data.usuario);
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                
                $scope.setUser = function (user) {
                    $scope.user = angular.copy(user);
                    var x = [];
                    for (var perfil in user.perfil) {
                        if (user.perfil[perfil] === "1")
                            x.push(perfil);
                    }
                    $scope.user.perfil = x;
                };


            }]);