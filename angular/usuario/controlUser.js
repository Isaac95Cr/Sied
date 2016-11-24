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
                    autentificacionService.logout(sessionService.token());
                };

                $scope.init = function () {
                    $scope.usuario = sessionService.getUsuario();
                    autentificacionService.getNotificacion().then(function (response) {
                        if(response.data.notificacion !== false)
                            $scope.notificaciones = response.data.notificacion;
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
                    autentificacionService.setNotificacion({id:id})
                            .success(function (data, status, headers, config) {
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });

                };


            }]);

