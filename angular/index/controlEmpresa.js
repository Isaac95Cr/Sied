angular.module("index")
        .controller("controlEmpresa", ['$scope', 'empdep', 'modalService', function ($scope, empdep, modalService) {

                $scope.empresas = [];
                $scope.empresaEdit = {
                    id: undefined,
                    nombre: undefined
                };
                $scope.empresaAdd = {
                    nombre: undefined
                };

                $scope.init = function () {
                    $scope.cargar();
                };
                $scope.selectEmpresa = function (empresa) {
                    empdep.setEmpresa(empresa);
                };
                $scope.cargar = function () {
                    empdep.cargarEmp().then(function () {
                        $scope.empresas = empdep.getEmpresas();
                    });
                };
                $scope.agregar = function () {
                    empdep.getEmpService().agregar($scope.empresaAdd).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.cargar();
                            $scope.empresaAdd.nombre = undefined;
                        }

                    });
                };
                $scope.confirmar = function (id) {
                    modalService.modalYesNo("Confirmacion", "<p>" + "¿Esta seguro de realizar la accion?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.eliminar({id: id});
                            });
                };
                $scope.eliminar = function (obj) {
                    empdep.getEmpService().eliminar(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.cargar();
                        }
                    });
                };
                $scope.modalModificar = function (empresa) {
                    $scope.selectEmpresa(empresa);
                    $scope.empresaEdit = empresa;
                    modalService.open("#modalEmpresaEdit");
                };
                $scope.modificar = function () {
                    empdep.getEmpService().modificar($scope.empresaEdit)
                            .then(function (res) {
                                if (res.status === 'error') {
                                    alert(res.message);
                                }
                                if (res.status === 'success') {
                                    $scope.empresaEdit.id = undefined;
                                    $scope.empresaEdit.nombre = undefined;
                                    $scope.cargar();
                                }
                            });
                };
            }]);