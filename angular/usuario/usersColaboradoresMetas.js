angular.module('usuario')
        .controller('usersColaboradoresMetas', ['$scope', 'userService', 'modalService', 'Navigator',
           function ($scope, userService, modalService, Navigator) {

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


    // función que pasa el id del usuario elegido
                $scope.pasarId = function (id) {
                    Navigator.goTo('', {idUser: id});
                };



            }]).value("tempStorage", {})
        .service("Navigator", function (tempStorage) {
            return {
                goTo: function (url, args) {
                    tempStorage.args = args;
                }
            };
        });


