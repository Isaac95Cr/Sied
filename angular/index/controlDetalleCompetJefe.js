angular.module("index")
        .controller("controlDetalleCompetJefe", ['$scope', 'factoryCompetenciasColab', 'userService', 'tempStorage', 'storageSession', '$crypto',                             
            function ($scope, factoryCompetenciasColab, userService, tempStorage, storageSession, $crypto) {

                $scope.competencias = "";
                $scope.colaborador = "";

                $scope.perfilCompet = "";  // aqui se guarda el id del perfil de competencia del usuario.
                $scope.userOnline = "";
                $scope.nombrePerfil = "";  // aquí se almacena el nombre del perfil de competencia

                $scope.init = function () {
                    
                    $scope.argumentosIdUser = tempStorage.args;
                    
                    if($scope.argumentosIdUser !== undefined){
                        $scope.infoIdUser = $scope.argumentosIdUser.idUser;
                        $scope.idEncrypt = $crypto.encrypt($scope.infoIdUser);
                        storageSession.saveId($scope.idEncrypt);
                                     
                    }else{
                        $scope.infoIdUser = $crypto.decrypt(storageSession.loadId());
                    }                    
                    
                    $scope.cargar();
                    $scope.cargarColaborador();
                    $scope.getPerfilCompetencia();
                };



                $scope.cargarColaborador = function () {
                    userService.cargarUsuario($scope.infoIdUser).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.colaborador = res.data.usuario.nombre + " " + res.data.usuario.apellido1 + " " + res.data.usuario.apellido2;
                        }
                    });
                };


                $scope.cargar = function () {
                    var colab = {id: $scope.infoIdUser};
                    factoryCompetenciasColab.cargarDetalleCompetenciasJefe(colab).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                                $scope.competencias = res.data;
                        }
                    });
                };



                $scope.getPerfilCompetencia = function () {
                    var colab = {id: $scope.infoIdUser};
                    return factoryCompetenciasColab.getPerfilCompetUser(colab).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                                $scope.perfilCompet = res.data.id;
                                $scope.nombrePerfil = res.data.nombre;
                        }
                    });

                };

            }]);



