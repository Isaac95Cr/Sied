angular.module("index")
        .controller("controlDepartamento", ['$scope', 'empdep', 'modalService', function ($scope, empdep, modalService) {

                $scope.departamentos = [];
                $scope.departamentoEdit = {
                    id: undefined,
                    nombre: undefined,
                    empresa: undefined
                };
                $scope.init = function () {
                    $scope.cargar();
                };
                $scope.filtro = function (departamento) {
                    return departamento.empresa == empdep.getEmpresa().id;
                };
                $scope.cargar = function () {
                    empdep.cargarDep().then(function () {
                        $scope.departamentos = empdep.getDepartamentos();
                    });
                };
                $scope.agregar = function () {
                    var obj = {
                        nombre: $scope.departamentoAdd,
                        empresa: empdep.getEmpresa()
                    };
                    empdep.getDepService().agregar(obj)
                            .success(function (data, status, headers, config) {
                                $scope.departamentoAdd = "";
                                $scope.cargar();
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
                    empdep.getDepService().eliminar({id: obj})
                            .success(function (data, status, headers, config) {
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.modalModificar = function (departamento) {
                    $scope.departamentoEdit = departamento;
                    modalService.open("#modalDepartamentoEdit");
                };
                $scope.modificar = function () {
                    empdep.getDepService().modificar($scope.departamentoEdit)
                            .success(function (data, status, headers, config) {
                                $scope.departamentoEdit.id = undefined;
                                $scope.departamentoEdit.nombre = undefined;
                                $scope.departamentoEdit.empresa = undefined;
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };

            }])
        

