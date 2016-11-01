angular.module("index")
        .controller("controlUsuario", ["$scope", "modalService", "userService", function ($scope, modalService, userService) {
                $scope.users = [];
                $scope.userAdd = {};
                $scope.userEdit = {};
                $scope.init = function () {
                    $scope.cargar();
                };
                $scope.cargar = function(){
                    userService.cargarUsuarios()
                            .success(function (data, status, headers, config) {
                                $scope.users = data.usuarios;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };
            }]);