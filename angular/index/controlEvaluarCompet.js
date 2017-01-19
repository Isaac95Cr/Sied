angular.module("index")
        .controller("controlEvaluarCompet", ['$scope', 'servicioCompetColab', 'servicioCompetAutoEv',
            'servicioCompetUser', 'modalService', 'tempStorage', 'storageSession', '$crypto',
            function ($scope, servicioCompetColab, servicioCompetAutoEv,
                    servicioCompetUser, modalService, tempStorage, storageSession, $crypto) {

                $scope.competencias = "";
                $scope.colaborador = "";
                $scope.stringAutoEvaluaciones = "";
                $scope.arrayAutoEvaluacionesCompet = [];
                $scope.arrayTemporalAutoEv = new Array();
                $scope.arrayAutoEvaluacionesList = new Array();

                $scope.autoEvaluacion = new Array();
                $scope.autoEvaluaciones = new Array();
                $scope.CompetAutoEv = new Array();

                $scope.arrayEvaluaciones = new Array();
                $scope.idCompetencias = new Array();

                $scope.tiene_Competencias = true;  // para saber si su perfil (en caso de tener) tiene competencias asociadas.

                $scope.init = function () {

                    $scope.argumentosIdUser = tempStorage.args;

                    if ($scope.argumentosIdUser !== undefined) {
                        $scope.infoIdUser = $scope.argumentosIdUser.idUser;
                        $scope.idEncrypt = $crypto.encrypt($scope.infoIdUser);
                        storageSession.saveId($scope.idEncrypt);

                    } else {
                        $scope.infoIdUser = $crypto.decrypt(storageSession.loadId());
                    }

                    // Primero se solicitan las autoevaluaciones al servidor, después se cargan en los scopes.
                    // Luego se solicitan los detalles de competencia, después se cargan en los scopes los
                    // detalles y sus respectivas autoevaluaciones.

                    servicioCompetAutoEv.loadAutoEvaluacionesService({id: $scope.infoIdUser}).then(function () {

                        $scope.cargarAutoEvaluaciones();   // se cargan en los scopes las autoevaluaciones
                        $scope.cargarEvaluaciones();  // se cargan en los scopes las evaluaciones

                    }).then(function () {

                        return servicioCompetColab.loadDetalles({id: $scope.infoIdUser});

                    }).then(function () {

                        $scope.cargarDetalles_AutoEval();   // se cargan en los scopes detalles y sus respectivas autoevaluaciones

                    }).then(function () {

                        return servicioCompetUser.loadColaborador($scope.infoIdUser);

                    }).then(function () {

                        $scope.cargarColaborador();
                    });


                };
                




                $scope.cargarColaborador = function () {
                    $scope.colaborador = servicioCompetUser.getNombreUsuario();
                };


                $scope.cargarDetalles_AutoEval = function () {
                    $scope.competencias = servicioCompetColab.getCompetencias();
                    
                    if($scope.competencias.length === 0){
                        $scope.tiene_Competencias = false;
                    }
                        
                        
                    var contador = 0;  // para acceder a las posiciones del array de autoevaluaciones y de evaluaciones
                    var obj = {};
                    angular.forEach($scope.competencias, function (elemento, key) {

                        $scope.idCompetencias = $scope.idCompetencias.concat(elemento.id);
                        if (elemento.detalles.length === 0)
                            contador++;
                        
                        angular.forEach(elemento.detalles, function (elementoD, keyD) {

                            // Hay que verificar si están las autoevaluaciones y las evaluaciones...

                            if ($scope.arrayAutoEvaluacionesList[contador] !== undefined) {
                                if ($scope.arrayEvaluaciones[contador] !== undefined)
                                    obj = {descrip: elementoD.descripcion, valor: $scope.arrayAutoEvaluacionesList[contador],
                                        valor2: $scope.arrayEvaluaciones[contador]};
                                else
                                    obj = {descrip: elementoD.descripcion, valor: $scope.arrayAutoEvaluacionesList[contador],
                                        valor2: "0"};
                            } else if ($scope.arrayEvaluaciones[contador] !== undefined) {
                                obj = {descrip: elementoD.descripcion, valor: "-", valor2: $scope.arrayEvaluaciones[contador]};
                            } else {
                                obj = {descrip: elementoD.descripcion, valor: "-", valor2: "0"};
                            }

                            contador++;
                            $scope.autoEvaluacion = $scope.autoEvaluacion.concat([obj]);
                        });
                        $scope.autoEvaluaciones = $scope.autoEvaluaciones.concat([$scope.autoEvaluacion]);
                        $scope.autoEvaluacion = [];
                    });
                };




                $scope.cargarAutoEvaluaciones = function () {

                    $scope.stringAutoEvaluaciones = servicioCompetAutoEv.getStringAutoEv();
                    if ($scope.stringAutoEvaluaciones !== "" && $scope.stringAutoEvaluaciones !== null && $scope.stringAutoEvaluaciones !== undefined) {

                        $scope.arrayAutoEvaluacionesCompet = $scope.stringAutoEvaluaciones.split(';');

                        angular.forEach($scope.arrayAutoEvaluacionesCompet, function (elemento, key) {

                            // arrayAutoEvaluacionesList contiene la lista de autoevaluaciones
                            $scope.arrayTemporalAutoEv = elemento.split(',');
                            $scope.arrayAutoEvaluacionesList = $scope.arrayAutoEvaluacionesList.concat($scope.arrayTemporalAutoEv);
                            $scope.arrayTemporalAutoEv = [];
                        });
                    }
                };


                // Carga las evaluaciones de competencia en un array
                $scope.cargarEvaluaciones = function () {

                    var evaluacionesString = servicioCompetAutoEv.getStringEvaluacion();
                    if (evaluacionesString !== "" && evaluacionesString !== null && evaluacionesString !== undefined)
                        $scope.arrayEvaluaciones = evaluacionesString.split(',');

                };
                
                
                
               $scope.is_TodasEvalCompet = function (listaMetas) {
                    return listaMetas.every(elem => (elem !== '0'));
                };



                $scope.confirmarEvaluacion = function (id) {
                    modalService.modalYesNo("Confirmación", "<p>" + "¿Está seguro de realizar la acción?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.evaluar();
                            });
                };



                 // Guardar Evaluaciones de Detalles de Competencias
                $scope.evaluar = function () {
                    var obj;
                    var idDetalles = servicioCompetAutoEv.getIDAutoEv();  // id de las evaluaciones en la bd.
                    var stringEvaluaciones = "";
                    
                    
                   angular.forEach($scope.idCompetencias, function (id_Elemento, key) {

                        /*
                         Encontrar los inputs que tengan el mismo name, con lo cual corresponden a una competencia
                         en específico.
                         */
                        $scope.inputs = angular.element(document).find('input').filter(document.getElementsByName(id_Elemento));           
                        
                        if($scope.inputs.length === 0)
                            stringEvaluaciones = stringEvaluaciones + ",";
                        
                            // Se recorren los inputs...
                            angular.forEach($scope.inputs, function (elemento, key) {
                                (elemento.value === "") ?
                                        stringEvaluaciones = stringEvaluaciones + "0,"
                                        :
                                        stringEvaluaciones = stringEvaluaciones + elemento.value + ",";

                            });

                    });

                    stringEvaluaciones = stringEvaluaciones.substr(0, stringEvaluaciones.length - 1);
                    obj = {id: idDetalles, evaluaciones: stringEvaluaciones, idColab: $scope.infoIdUser };

                    servicioCompetAutoEv.actualizarEvaluacionesDetalles(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Éxito", "<p>" + res.message + "</p>");
                            $scope.listEvaluaciones = stringEvaluaciones.split(',');
                            if($scope.is_TodasEvalCompet($scope.listEvaluaciones)){
                                servicioCompetAutoEv.notificarEvalCompet($scope.infoIdUser);
                            }
                        }
                    });

                };





            }])
        .factory("factoryAutoEvCompetencias", function (apiConnector) {

            var autoEv_Competencia = {};
            var stringAutoEv = undefined;  // se recibe el string de las autoevaluaciones
            var stringEvaluaciones = undefined;   // se recibe el string de las evaluaciones
            var IDAutoevaluaciones = undefined;   // aquí se guarda el id de la base de datos correspondiente a las autoevaluaciones 
            // de competencias.
            
            autoEv_Competencia.notificarEvalCompetencias = function (obj) {
                return apiConnector.post('api/evaluaciones/notificacionEvaCompetencias/', obj);
            };

            autoEv_Competencia.cargarAutoEvCompet = function (obj) {
                return apiConnector.post('api/evaluacionCompetencias/allAutoFromUser', obj);
            };

            autoEv_Competencia.updateEvaluacionesDetalles = function (obj) {
                return apiConnector.put('api/evaluacionCompetencias/set', obj);
            };

            autoEv_Competencia.getIdBD = function () {
                return IDAutoevaluaciones;
            };


            autoEv_Competencia.loadAutoEvaluacionesCompet = function (colab) {
                return this.cargarAutoEvCompet(colab).then(function (res) {
                    if (res.status === 'error') {
                        alert(res.message);
                    }
                    if (res.status === 'success') {
                        var tamanoData = res.data.length;
                        stringAutoEv = "";
                        if (tamanoData !== 0) {
                            stringAutoEv = res.data[0].auto_evaluacion;
                            stringEvaluaciones = res.data[0].evaluacion;
                            IDAutoevaluaciones = res.data[0].id;
                        }
                    }
                });
            };


            autoEv_Competencia.getStringAutoEvaluaciones = function () {
                return stringAutoEv;
            };


            autoEv_Competencia.getStringEvaluaciones = function () {
                return stringEvaluaciones;
            };

            return autoEv_Competencia;
        })
        .service('servicioCompetAutoEv', ['factoryAutoEvCompetencias', function (factoryAutoEvCompetencias) {

                this.loadAutoEvaluacionesService = function (obj) {
                    return factoryAutoEvCompetencias.loadAutoEvaluacionesCompet(obj);
                };

                this.getStringAutoEv = function () {
                    return factoryAutoEvCompetencias.getStringAutoEvaluaciones();
                };

                this.getStringEvaluacion = function () {
                    return factoryAutoEvCompetencias.getStringEvaluaciones();
                };

                this.getIDAutoEv = function () {
                    return factoryAutoEvCompetencias.getIdBD();
                };

                this.actualizarEvaluacionesDetalles = function (obj) {
                    return factoryAutoEvCompetencias.updateEvaluacionesDetalles(obj);
                };
                
                
                this.notificarEvalCompet = function (obj) {
                    return factoryAutoEvCompetencias.notificarEvalCompetencias(obj);
                };

            }]);

