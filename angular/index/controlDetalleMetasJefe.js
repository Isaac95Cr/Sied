angular.module("index")
        .controller("controlDetalleMetasJefe", ['$scope', 'factoryMeta', 'userService', 'tempStorage', 'storageSession', '$crypto',
                            function ($scope, factoryMeta, userService, tempStorage, storageSession, $crypto) {

                $scope.metasUser = [];
                $scope.tiene_Metas = true;
                $scope.colaborador = "";


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
                };


                $scope.cargar = function () {
                    var obj = {id: $scope.infoIdUser};
                    factoryMeta.cargarMetasUser(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.metasUser = res.data;
                            if ($scope.metasUser.length === 0)
                                $scope.tiene_Metas = false;
                        }
                    });
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


            }]).service("storageSession", function ($sessionStorage) {
            
                var sesion = {};
                
                sesion.saveId = function (id){
                    $sessionStorage.idUser = id;       
                };
                               
                sesion.loadId = function (){
                    var id;
                    id = $sessionStorage.idUser;
                    return id;
                };
                
                return sesion;
        }).config(['$cryptoProvider', function($cryptoProvider){
                
                 $cryptoProvider.setCryptographyKey('ABCD123');
   }]);




