angular.module('registro')
        .controller('controlLogin', ['$scope', 'modalService', 'autentificacionService', 'sessionService', function ($scope, modalService, autentificacionService, sessionService) {
                $scope.user = {};
                $scope.login = function () {
                    autentificacionService.login($scope.user);
                    $scope.session = sessionService.userId;
                };
                $scope.session = sessionService.userId;

            }]);

