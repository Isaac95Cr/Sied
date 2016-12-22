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
                    if (empdep.getEmpresa() !== undefined)
                        return departamento.empresa == empdep.getEmpresa().id;
                    else
                        return false;
                };
                $scope.selectEmpresa = function (empresa) {
                    empdep.setEmpresa(empresa);
                };


                $scope.agregarUsuario = function () {
                    userService.insert($scope.user).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Éxito", "<p>" + res.message + "</p>");
                            $scope.user = {};
                        }
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

