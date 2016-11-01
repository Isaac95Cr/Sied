angular.module('registro')
        .controller('controlLogin', ['$scope', 'modalService', 'autentificacionService', 'sessionService', function ($scope, modalService, autentificacionService, sessionService) {
                
                $scope.login = function () {
                    autentificacionService.login($scope.user);
                };
                $scope.logout = function () {
                    autentificacionService.logout(sessionService.token());
                };
                $scope.init = function () {
                    $scope.usuario = sessionService.getUsuario();
                };

            }]);

