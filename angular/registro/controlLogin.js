angular.module('registro')
        .controller('controlLogin', ['$scope', 'modalService', 'autentificacionService', 'sessionService', function ($scope, modalService, autentificacionService, sessionService) {
                
                $scope.login = function () {
                    autentificacionService.login($scope.user);
                };
                $scope.logout = function () {
                    autentificacionService.logout(sessionService.token());
                };
                $scope.correoContrasena = function () {
                    autentificacionService.correoContrasena($scope.user);
                };
                
                $scope.init = function () {
                    $scope.usuario = sessionService.getUsuario();
                };
                
            }]);

