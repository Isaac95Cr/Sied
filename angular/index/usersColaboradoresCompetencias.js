angular.module('usuario')
        .controller('usersColaboradoresCompetencias', ['$scope', 'userService', 'Navigator', 'servicioCompetColab',
            function ($scope, userService, Navigator, servicioCompetColab) {

                $scope.listaUsuarios = [];
                $scope.userID = "";
                $scope.userOnline = undefined;
                $scope.tiene_Metas = true;


                $scope.init = function () {
                    $scope.getUserOnline();
                    $scope.cargar();
                };

                // función que pasa el id del usuario elegido
                $scope.pasarId = function (id) {
                    Navigator.goTo('', {idUser: id});
                };


                $scope.cargar = function () {
                    userService.cargarUsuariosDeJefe($scope.userOnline).then(function (res) {
                        if (res.status === 'error') {
                            $scope.tiene_Metas = false;
                        }
                        if (res.status === 'success') {
                            $scope.listaUsuarios = res.data;
                        }
                    });
                };


                $scope.getUserOnline = function () {
                    servicioCompetColab.loadUsuarioId();
                    $scope.userOnline = servicioCompetColab.getUsuarioID();
                };

            }]);


