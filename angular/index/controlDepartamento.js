angular.module("index")
        .controller("controlDepartamento", ['$scope', 'empdep', 'modalService','ShareDataService', function ($scope, empdep, modalService,ShareDataService) {
                $scope.departamento ={};
                $scope.depBool = true;
                $scope.departamentos = [];
                $scope.departamentoEdit = {
                    id: undefined,
                    nombre: undefined,
                    empresa: undefined
                };
                $scope.departamentoAdd = {
                    nombre: undefined
                };
                $scope.init = function () {
                    $scope.cargar();
                };
                
                $scope.empresaSeleccionada = "";
                
                $scope.updateEmpresaSelect = function () {
                    if(empdep.getEmpresa() !== undefined)
                        $scope.empresaSeleccionada = empdep.getEmpresa().nombre;
                    return $scope.empresaSeleccionada;
                };
                
                // Para limpiar la modal cuando se le da 'x' de cerrar o Cancelar.
                $scope.resetForm = function (form) {
                    form.$setPristine();
                    form.$setUntouched();
                };
                       
//                $scope.filtro = function (departamento) {
//                    return departamento.empresa == empdep.getEmpresa().id;
//                };
//                
                $scope.filtro = function (departamento) {
                    if(empdep.getEmpresa() !== undefined)
                        return departamento.empresa == empdep.getEmpresa().id;
                    else
                        return false;
                };
                
                $scope.cargar = function () {
                    empdep.cargarDep().then(function () {
                        $scope.departamentos = empdep.getDepartamentos();
                    });
                };
                $scope.agregar = function (idForm) {
                    var obj = {
                        nombre: $scope.departamentoAdd.nombre,
                        empresa: empdep.getEmpresa()
                    };
                    empdep.getDepService().agregar(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.cargar();
                            $scope.resetForm(idForm);
                            $scope.departamentoAdd.nombre = undefined;
                        }
                    });

                };
                $scope.confirmar = function (id) {
                    modalService.modalYesNo("Confirmacion", "<p>" + "¿Esta seguro de realizar la accion?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.eliminar({id:id});
                            });
                };
                $scope.eliminar = function (obj) { // id
                    empdep.getDepService().eliminar(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.cargar();
                        }
                    });
                };
                $scope.modalModificar = function (departamento) {
                    $scope.departamentoEdit = departamento;
                    modalService.open("#modalDepartamentoEdit");
                };
                $scope.modificar = function () {
                    empdep.getDepService().modificar($scope.departamentoEdit)
                            .then(function (res) {
                                if (res.status === 'error') {
                                    alert(res.message);
                                }
                                if (res.status === 'success') {
                                    $scope.departamentoEdit.id = undefined;
                                    $scope.departamentoEdit.nombre = undefined;
                                    $scope.departamentoEdit.empresa = undefined;
                                    $scope.cargar();
                                }
                            });
                };
                $scope.setDepartamento = function(departamento){
                    $scope.departamento = departamento;
                    $scope.depBool = false;
                };
                $scope.isSelected = function(id){
                    return id === $scope.departamento.id;
                };
                $scope.reporte = function (dep) {
                    location.href = 'http://localhost/Sied/reportes/reporteDepartamento.php?dep=' + $scope.departamento.id + '&periodo=' + $scope.periodo;
                };

                $scope.$on('handleBroadcast', function () {
                    $scope.periodo = ShareDataService.msg;
                });
                
            }]);


