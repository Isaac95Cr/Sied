angular.module("index")
        .controller("controlEvaluarMetas", ['$scope', 'factoryMeta', 'userService', '$routeParams', 'modalService', 
                             'tempStorage', 'storageSession', '$crypto',
                             function ($scope, factoryMeta, userService, $routeParams, modalService, tempStorage, storageSession, $crypto) {

                $scope.metasUser = [];
                $scope.tiene_Metas = true;
                $scope.isEvaluables = true;  // para saber si hay metas por evaluar, y que hayan sido aprobadas por Jefe y RH.
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
                    return factoryMeta.cargarMetasUser(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.metasUser = res.data;
                            if ($scope.metasUser.length === 0){
                                $scope.tiene_Metas = false;
                            }else{
                                $scope.isEvaluables = 
                                        $scope.metasUser.some(elem => (elem.evaluable === '1' && elem.aprobacion_j === '1' && elem.aprobacion_rh === '1'));
                            }
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



                $scope.confirmarEvaluacion = function (id) {
                    modalService.modalYesNo("Confirmación", "<p>" + "¿Está seguro de realizar la acción?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.evaluar();
                            });
                };


                $scope.evaluar = function () {
                    $scope.objEv = new Array();
                    $scope.inputs = angular.element(document).find('input');  // Obtiene todos los inputs de la página;
                    var obj;
                    // Se recorren los inputs...
                    angular.forEach($scope.inputs, function (elemento, key) {
                        (elemento.value === "") ?
                                obj = {id: elemento.id, valor: "0"}
                        :
                                obj = {id: elemento.id, valor: parseInt(elemento.value)};

                        $scope.objEv.push(obj);
                    });


                    factoryMeta.updateEvaluaciones($scope.objEv).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Éxito", "<p>" + res.message + "</p>");
                            $scope.notificar();
                        }
                    });
                    
                };
                
                
                $scope.is_TodasEvaluadas = function (listaMetas) {
                    return listaMetas.every(elem => (elem.evaluacion !== null));
                };
                
               $scope.notificar = function(){
                        $scope.cargar().then(function () {
                        if ($scope.is_TodasEvaluadas($scope.metasUser)) {
                            factoryMeta.notificarEvalMetas($scope.infoIdUser);
                        }
                     });
                };
                
                
            }]);

