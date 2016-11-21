angular.module('usuario')
        .controller('controlUser', ['$scope', '$location', '$window', 'autentificacionService', 'sessionService', function ($scope, $location, $window, autentificacionService, sessionService) {
                $scope.user = {};
                $scope.notificaciones = [];
                $scope.token = undefined;

                $scope.visto = function (x) {
                    return (x.visto == 0);
                };

                $scope.login = function () {
                    autentificacionService.login($scope.user);
                };
                $scope.logout = function () {
                    autentificacionService.logout(sessionService.token());
                };

                $scope.init = function () {
                    $scope.usuario = sessionService.getUsuario();
                    autentificacionService.getNotificacion().then(function (response) {
                        $scope.notificaciones = response.data.notificacion;
                    });
                };

                $scope.setUser = function () {
                    $scope.user = sessionService.getUserFromToken($scope.token).user;
                };


            }]);

