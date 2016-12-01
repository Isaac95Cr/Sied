angular.module('usuario')
        .controller('controlUser', ['$scope', '$location', '$window', 'autentificacionService', 'sessionService', function ($scope, $location, $window, autentificacionService, sessionService) {
                $scope.user = {};
                $scope.notificaciones = [];
                $scope.token = undefined;

                $scope.visto = function (x) {
                    return (x.visto === "0");
                };
                $scope.vistoN = function (x) {
                    return (x.visto === "1");
                };

                $scope.login = function () {
                    autentificacionService.login($scope.user);
                };
                $scope.logout = function () {
                    autentificacionService.logout({token:sessionService.token()});
                };

                $scope.init = function () {
                    $scope.usuario = sessionService.getUsuario();
                    autentificacionService.getNotificacion({id:$scope.usuario.id}).then(function (res) {
                        $scope.notificaciones = res.data;
                    });
                };

                $scope.setUser = function () {
                    $scope.user = sessionService.getUserFromToken($scope.token).user;
                };
                $scope.notificacionVista = function (notificacion) {
                    var x = $scope.notificaciones.findIndex(function (x) {
                        return x.id === notificacion.id;
                    });
                    $scope.notificaciones[x].visto = "1";
                    $scope.setVisto(notificacion.id);
                };
                $scope.setVisto = function (id) {
                    autentificacionService.setNotificacion({id: id}).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                        }
                    });

                };


            }]);

