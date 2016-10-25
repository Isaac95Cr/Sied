angular.module('registro')
        .controller('controlLogin', ['$scope', 'modalService', 'autentificacionService', 'sessionService', function ($scope, modalService, autentificacionService, sessionService) {
                $scope.user = sessionService.load();                
                $scope.login = function () {
                    autentificacionService.login($scope.user);
                };
                $scope.logout = function () {
                    autentificacionService.logout();
                };

            }]);

