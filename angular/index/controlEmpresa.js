angular.module("index")
        .controller("controlEmpresa", ['$scope', 'empdep', 'modalService', function ($scope, empdep, modalService) {

                $scope.empresas = [];
                $scope.empresaEdit = {
                    id: undefined,
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
                    empdep.getEmpService().agregar($scope.empresaAdd)
                            .success(function (data, status, headers, config) {
                                $scope.cargar();
                                $scope.empresaAdd = "";
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.confirmar = function (id) {
                    modalService.modalYesNo("Confirmacion", "<p>" + "¿Esta seguro de realizar la accion?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.eliminar(id);
                            });
                };
                $scope.eliminar = function (obj) { // id
                    empdep.getEmpService().eliminar(obj)
                            .success(function (data, status, headers, config) {
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.modalModificar = function (empresa) {
                    $scope.selectEmpresa(empresa);
                    $scope.empresaEdit = empresa;
                    modalService.open("#modalEmpresaEdit");
                };
                $scope.modificar = function () {
                    empdep.getEmpService().modificar($scope.empresaEdit)
                            .success(function (data, status, headers, config) {
                                $scope.empresaEdit.id = undefined;
                                $scope.empresaEdit.nombre = undefined;
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
            }])