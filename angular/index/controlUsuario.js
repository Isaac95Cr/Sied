angular.module("index")
        .controller("controlUsuario", ["$scope", "modalService", "userService", "empdep", function ($scope, modalService, userService, empdep) {
                $scope.users = [];
                $scope.userAdd = {};
                $scope.userEdit = {};
                $scope.user = {
                    empresa: undefined,
                    departamento: undefined
                };
                $scope.opciones = ["Colaborador", "Jefe", "RH"];

                $scope.init = function () {
                    $scope.cargar();
                };

                $scope.selectUserEdit = function (user) {
                    $scope.userEdit = user;
                    var x = [];
                    for (var perfil in user.perfil) {
                        if (user.perfil[perfil] === "1")
                            x.push(perfil);
                    }
                    $scope.userEdit.perfil = x;
                    empdep.setEmpresa()
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
                $scope.modalModificar = function (user) {
                    $scope.selectUserEdit(user);
                    modalService.open("#modalUserEdit");
                };

                /*$scope.$on('departamento', function () {
                    $scope.userEdit.empresa = ShareDataService.empresa;
                    $scope.userEdit.departamento = ShareDataService.departamento.selected;
                    $scope.userAdd.empresa = ShareDataService.empresa;
                    $scope.userAdd.departamento = ShareDataService.departamento.selected;
                });*/
            }]);