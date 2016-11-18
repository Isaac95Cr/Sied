angular.module('registro')
        .controller('controlRegistro', ['$scope', 'factoryEmpresa', 'factoryDepartamento', 'ShareDataService', 'userService', 'modalService',
            function ($scope, factoryEmpresa, factoryDepartamento, ShareDataService, userService, modalService) {
                $scope.user = {};
                $scope.bandera = true;
                
                $scope.agregarUsuario = function () {
                    userService.insert($scope.user)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.user = {};
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                
                $scope.validar = function (){
                    if( $scope.user.departamento){
                        $scope.bandera = false;
                    }
                };
                $scope.confirmarContrasena = function () {
                    return $scope.user.contrasena === $scope.user.contrasena2;
                };

                $scope.$on('departamento', function () {
                    $scope.user.departamento = ShareDataService.departamento.id;
                    $scope.validar();
                });
                $scope.$on('handleBroadcast', function () {
                    $scope.validar();
                });
            }]);

