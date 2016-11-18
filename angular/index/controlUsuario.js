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
                    userService.cargarUsuarios()
                            .success(function (data, status, headers, config) {
                                $scope.users = data.usuarios;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };
                $scope.agregar = function () {
                    userService.insert($scope.userAdd)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.userAdd = {};
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.modificar = function () {
                    userService.update($scope.userEdit)
                            .success(function (data, status, headers, config) {
                                alert(data);
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.userEdit = {};
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.modalModificar = function (user) {
                    $scope.selectUserEdit(user);
                    modalService.open("#modalUserEdit");
                };

                $scope.filtro = function (departamento) {
                    return departamento.empresa == empdep.getEmpresa().id;
                };
                /*$scope.$on('departamento', function () {
                 $scope.userEdit.empresa = ShareDataService.empresa;
                 $scope.userEdit.departamento = ShareDataService.departamento.selected;
                 $scope.userAdd.empresa = ShareDataService.empresa;
                 $scope.userAdd.departamento = ShareDataService.departamento.selected;
                 });*/
            }]);