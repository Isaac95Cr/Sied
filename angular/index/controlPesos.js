angular.module("index")
        .controller("controlPesos", ['$scope', 'factoryCompetencia', 'ShareDataService', 'modalService', function ($scope, factoryCompetencia, ShareDataService, modalService) {
                $scope.competencias = {};
                $scope.sum = 0;

                $scope.$on('handleBroadcast', function () {
                    $scope.competencias = ShareDataService.msg.competencias;
                    $scope.getTotal();
                });
                Number.prototype.round = function (p) {
                    p = p || 10;
                    return parseFloat(this.toFixed(p));
                };
                $scope.init = function () {
                    $scope.getTotal();
                };
                $scope.getTotal = function () {
                    $scope.sum = 0;
                    var x = 0;
                    $scope.competencias.forEach(function (competencia) {
                        x += parseFloat(competencia.peso);
                    });
                    $scope.sum = x.round(2);
                };
                $scope.modificarPeso = function () {
                    factoryCompetencia.modificarPeso($scope.competencias)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                    ;

                };
            }
        ]);
