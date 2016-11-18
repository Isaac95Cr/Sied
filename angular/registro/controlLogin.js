angular.module('registro')
        .controller('controlLogin', ['$scope', '$location', '$window', 'modalService', 'autentificacionService', 'sessionService', function ($scope, $location, $window, modalService, autentificacionService, sessionService) {
                $scope.user = {};
                $scope.token = undefined;
                $scope.bandera = true;

                $scope.login = function () {
                    autentificacionService.login($scope.user);
                };
                $scope.logout = function () {
                    autentificacionService.logout(sessionService.token());
                };
                $scope.correoContrasena = function () {
                    $scope.bandera = false;
                    autentificacionService.correoContrasena($scope.user)
                            .then(function (response) {
                        modalService.modalOk("Reset Contraseña", "<p>"+response.data.mensaje+"</p>");
                    });
                };
                $scope.setContrasena = function () {
                    $scope.bandera = false;
                    autentificacionService.setContrasena({user: $scope.user, token: $scope.token})
                            .then(function (response) {
                                modalService.modalOk("Reset Contraseña", "<p>"+response.data.mensaje+"</p>");
                            });
                };

                $scope.init = function () {
                    $scope.usuario = sessionService.getUsuario();
                };
                $scope.initLogin = function () {

                };
                $scope.initReset = function () {
                    var token = $location.search().token;
                    if (token == undefined || token === "") {
                        $window.location.href = 'login.php';
                    }
                    $scope.token = token;
                    $scope.setUser();
                };
                $scope.setUser = function () {
                    $scope.user = sessionService.getUserFromToken($scope.token).user;
                };

                $scope.confirmarContrasena = function () {
                    return $scope.user.contrasena === $scope.user.contrasena2;
                };

            }]);

