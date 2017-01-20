angular.module("index")
        .controller("controlUsuario", ["$scope", "modalService", "userService", "empdep", "apiConnector", "ShareDataService", function ($scope, modalService, userService, empdep, apiConnector, ShareDataService) {

                $scope.userAdd = {};
                $scope.userEdit = {};
                $scope.user = {
                    empresa: undefined,
                    departamento: undefined
                };
                $scope.users = [];
                $scope.solicitudes = [];
                $scope.competencias = [];
                $scope.empresas = [];
                $scope.departamentos = [];
                $scope.opciones = ["Colaborador", "Jefe", "RH"];
                $scope.bandera = false;
                $scope.jefeb = false;

                $scope.init = function () {
                    $scope.cargar();
                    empdep.cargarEmp().then(function () {
                        $scope.empresas = empdep.getEmpresas();
                    });
                    empdep.cargarDep().then(function () {
                        $scope.departamentos = empdep.getDepartamentos();
                    });
                    $scope.cargarCompetencias();
                };
                $scope.selectEmpresa = function (empresa) {
                    empdep.setEmpresa(empresa);
                    $scope.userEdit.departamento = undefined;
                    $scope.userAdd.departamento = undefined;
                };
                $scope.selectUserEdit = function (user) {
                    $scope.userEdit = angular.copy(user);
                    var x = [];
                    for (var perfil in user.perfil) {
                        if (user.perfil[perfil] === "1")
                            x.push(perfil);
                    }
                    $scope.userEdit.perfil = x;
                    $scope.jefeb = (user.perfil.Jefe == 1);
                    if ($scope.jefeb) {
                        $scope.jefeb = true;
                    } else {
                        $scope.jefeb = false;
                    }
                    $scope.userEdit.empresa = empdep.buscarEmpresa(user.empresa);
                    $scope.selectEmpresa($scope.userEdit.empresa);
                    $scope.userEdit.departamento = empdep.buscarDepartamento(user.departamento);
                    $scope.userEdit.perfilcompetencia = {nombre: user.nombrePerfil, id: user.perfilId};
                };
                $scope.cargar = function () {
                    userService.cargarUsuarios().then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.users = res.data;
                        }
                    });
                    userService.cargarSolicitudes().then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.solicitudes = res.data;
                        }
                    });
                };
                $scope.cargarCompetencias = function () {
                    apiConnector.get("api/perfilCompetencias/only").then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.competencias = res.data;
                        }
                    });
                };
                $scope.agregar = function () {
                    userService.insert($scope.userAdd).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.userAdd = {};
                            $scope.cargar();
                            modalService.modalOk("Exito", "<p>" + res.message + "</p>");
                        }
                    });
                };
                $scope.modificar = function () {
                    userService.update($scope.userEdit).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.userEdit = {};
                            $scope.cargar();
                            modalService.modalOk("Exito", "<p>" + res.message + "</p>");
                        }
                    });
                };
                $scope.modalModificar = function (user, bool) {
                    $scope.bandera = bool;
                    $scope.selectUserEdit(user);
                    modalService.open("#modalUserEdit");
                };
                $scope.confirmar = function () {
                    modalService.modalYesNo("Confirmacion", "<p>" + "¿Esta seguro de realizar la accion?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.eliminar();
                            });
                };
                $scope.eliminar = function () {
                    userService.eliminar($scope.userEdit.id).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.cargar();
                        }
                    });
                };

                $scope.filtro = function (departamento) {
                    if (empdep.getEmpresa() !== undefined)
                        return departamento.empresa == empdep.getEmpresa().id;
                    else
                        return false;
                };

                // Para limpiar la modal cuando se le da 'x' de cerrar o Cancelar.
                $scope.resetForm = function (form) {
                    form.$setPristine();
                    form.$setUntouched();
                };

                $scope.filtroSolicitud = function (usuario) {

                };
                $scope.tienePerfil = function (user) {
                    return !(user.perfil.Colaborador == 1 || user.perfil.Jefe == 1 || user.perfil.RH == 1);
                };
                $scope.reporte = function (user) {
                    location.href = 'http://localhost/Sied/reportes/reporteBasico.php?usuario=' + user.id + '&periodo=' + $scope.periodo;
                };

                $scope.$on('handleBroadcast', function () {
                    $scope.periodo = ShareDataService.msg;
                });

                $scope.onSelect = function (item) {
                    if (item === 'Jefe')
                        $scope.jefeb = true;
                };

                $scope.onRemove = function (item) {
                    if (item === 'Jefe')
                        $scope.jefeb = false;
                };

                /*$scope.$on('departamento', function () {
                 $scope.userEdit.empresa = ShareDataService.empresa;
                 $scope.userEdit.departamento = ShareDataService.departamento.selected;
                 $scope.userAdd.empresa = ShareDataService.empresa;
                 $scope.userAdd.departamento = ShareDataService.departamento.selected;
                 });*/
            }]);
