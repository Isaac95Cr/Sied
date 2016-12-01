angular.module('usuario')
        .controller('usersColaboradoresCompetencias', ['$scope', 'userService', 'modalService', function ($scope, userService, modalService) {

                $scope.listaUsuarios = [];
                $scope.userID = "";


                $scope.init = function () {
                    $scope.cargar();
                };


                $scope.cargar = function () {
                    userService.cargarUsuarios().then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.listaUsuarios = res.data;
                        }
                    });
                };

            }]);


