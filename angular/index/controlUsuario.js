angular.module("index")
        .controller("controlUsuario", ["$scope", "modalService", "userService", function ($scope, modalService, userService) {
                $scope.users = [];
                $scope.userAdd = {};
                $scope.userEdit = {};
                $scope.user = {};
                $scope.estados = [
                    {estado: 'Activo', color:"green"},
                    {estado: 'Inactivo',color:"red"}
                ];
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

                $scope.modalModificar = function (user) {
                    $scope.selectUserEdit(user);
                    modalService.open("#modalUserEdit");
                };
            }]);