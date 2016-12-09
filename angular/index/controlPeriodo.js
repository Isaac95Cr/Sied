angular.module('index')
        .controller('controlPeriodo', ['$scope', function ($scope) {
                $scope.model = {
                    date1: {
                        startDate: undefined,
                        endDate: undefined
                    },
                    date2: {
                        startDate: undefined,
                        endDate: undefined
                    },
                    date3: {
                        startDate: undefined,
                        endDate: undefined
                    },
                    date4: {
                        startDate: undefined,
                        endDate: undefined
                    },
                    nombre: undefined
                };
                $scope.validar = function () {
                    return $scope.model.date2.startDate.isSameOrAfter($scope.model.date1.startDate)
                            && $scope.model.date3.startDate.isSameOrAfter($scope.model.date2.endDate)
                            && $scope.model.date4.startDate.isSameOrAfter($scope.model.date3.endDate)
                            && $scope.model.date4.endDate.isSameOrBefore($scope.model.date1.endDate);

                };
                $scope.time = function (x, moment) {
                    return $scope.$eval("model." + x + "." + moment);
                };
                $scope.$watch('model.date1',function(){
                    $scope.model.nombre = "Periodo" + ($scope.model.date1.startDate.month()+1)+"-"+($scope.model.date1.endDate.month()+1)+ "/"+ $scope.model.date1.startDate.year();
                },true);


            }]);