angular.module('registro')
        .controller('controlRegistro', ['$scope', 'userService', 'modalService', 'empdep',
            function ($scope, userService, modalService, empdep) {
                $scope.user = {};
                $scope.bandera = true;

                $scope.init = function () {
                    empdep.cargarEmp().then(function () {
                        $scope.empresas = empdep.getEmpresas();
                    });
                    empdep.cargarDep().then(function () {
                        $scope.departamentos = empdep.getDepartamentos();
                    });
                };
                $scope.filtro = function (departamento) {
                    return departamento.empresa == empdep.getEmpresa().id;
                };
                $scope.selectEmpresa = function (empresa) {
                    empdep.setEmpresa(empresa);
                }
                $scope.agregarUsuario = function () {
                    userService.insert($scope.user)
                            .success(function (data, status, headers, config) {
                                alert(data);
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.user = {};
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };

                $scope.validar = function () {
                    if ($scope.user.departamento) {
                        $scope.bandera = false;
                    }
                };
                $scope.confirmarContrasena = function () {
                    return $scope.user.contrasena === $scope.user.contrasena2;
                };
            }]);

