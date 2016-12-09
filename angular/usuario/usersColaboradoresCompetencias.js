angular.module('usuario')
        .controller('usersColaboradoresCompetencias', ['$scope', 'userService', 'modalService', 'Navigator', 
                           function ($scope, userService, modalService, Navigator) {

                $scope.listaUsuarios = [];
                $scope.userID = "";


                $scope.init = function () {
                    $scope.cargar();
                };
                
    // función que pasa el id del usuario elegido
                $scope.pasarId = function (id) {
                    Navigator.goTo('', {idUser: id});
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


