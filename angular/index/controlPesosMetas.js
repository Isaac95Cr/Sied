angular.module("index")
        .controller("controlPesosMetas", ['$scope', 'factoryMeta', 'ShareDataService', 'modalService', function ($scope, factoryMeta, ShareDataService, modalService) {

                $scope.metas = [];
                $scope.sumaTotal = 0;


                $scope.$on('handleBroadcast', function () {
                    $scope.metas = ShareDataService.msg.metas;
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
                        $scope.sumaTotal = 0;
                        var x = 0;

                        $scope.metas.forEach(function (meta) {
                            x += parseFloat(meta.peso);
                        });

                        $scope.sumaTotal = x.round(2);
                };
                
                
                
                
                $scope.setPesosMetas = function () {
                    factoryMeta.modificarPeso($scope.metas).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Pesos", "<p>" + res.message + "</p>");
                        }
                    });
                };
                
                

            }]);

