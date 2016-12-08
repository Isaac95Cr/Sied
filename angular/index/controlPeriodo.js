angular.module('index')
        .controller('controlPeriodo', ['$scope', function ($scope) {
                $scope.model = {
                    date1: {
                        startDate: moment().subtract(2, "days"),
                        endDate: moment()
                    },
                    date2: {
                        startDate: moment().subtract(1, "days"),
                        endDate: moment()
                    }, 
                    date3: {
                        startDate: moment().subtract(1, "days"),
                        endDate: moment()
                    }, 
                    date4: {
                        startDate: moment().subtract(1, "days"),
                        endDate: moment()
                    }
                };
                $scope.init = function () {
                };
                $scope.time = function (x, moment) {
                    return $scope.$eval("model." + x + "." + moment);
                };


            }]);