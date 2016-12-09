angular.module("index")
        .controller("controlUsuario", ["$scope", "modalService", "userService", "empdep", function ($scope, modalService, userService, empdep) {
                $scope.users = [];
                $scope.userAdd = {};
                $scope.userEdit = {};
                $scope.user = {
                    empresa: undefined,
                    departamento: undefined
                };
                $scope.empresas = [];
                $scope.departamentos = [];
                $scope.opciones = ["Colaborador", "Jefe", "RH"];
                $scope.init = function () {
                    $scope.cargar();
                    empdep.cargarEmp().then(function () {
                        $scope.empresas = empdep.getEmpresas();
                    });
                    empdep.cargarDep().then(function () {
                        $scope.departamentos = empdep.getDepartamentos();
                    });
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
                    $scope.userEdit.empresa = empdep.buscarEmpresa(user.empresa);
                    $scope.selectEmpresa($scope.userEdit.empresa);
                    $scope.userEdit.departamento = empdep.buscarDepartamento(user.departamento);
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
                $scope.modalModificar = function (user) {
                    $scope.selectUserEdit(user);
                    modalService.open("#modalUserEdit");
                };
//                $scope.filtro = function (departamento) {
//                    return departamento.empresa == empdep.getEmpresa().id;
//                };


                $scope.filtro = function (departamento) {
                    if(empdep.getEmpresa() !== undefined)
                        return departamento.empresa == empdep.getEmpresa().id;
                    else
                        return false;
                };

                /*$scope.$on('departamento', function () {
                 $scope.userEdit.empresa = ShareDataService.empresa;
                 $scope.userEdit.departamento = ShareDataService.departamento.selected;
                 $scope.userAdd.empresa = ShareDataService.empresa;
                 $scope.userAdd.departamento = ShareDataService.departamento.selected;
                 });*/
            }]);