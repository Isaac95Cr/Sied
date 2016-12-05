angular.module("index")
        .controller("controlPesos", ['$scope', 'apiConnector', 'ShareDataService', 'modalService', function ($scope, apiConnector, ShareDataService, modalService) {
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
                    
                    apiConnector.put("api/competencias/setPeso", $scope.competencias).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Pesos", "<p>" + res.message + "</p>");
                        }
                    });
                };
            }
        ]);
