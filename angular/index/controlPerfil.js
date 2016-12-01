angular.module('index')
        .controller('controlPerfil', ['$scope', 'userService', 'sessionService', function ($scope, userService, sessionService) {
                $scope.user = {};
                $scope.init = function () {
                    $scope.cargar();
                };
                $scope.cargar = function () {
                    userService.cargarUsuario(sessionService.getUsuario().id).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                             $scope.setUser(res.data.usuario);
                        }
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