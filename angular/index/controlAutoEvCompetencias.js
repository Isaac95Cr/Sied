angular.module("index")
        .controller("controlAutoEvCompetencias", ['$scope', 'factoryCompetenciasColab', 'modalService',
            'servicioCompetAutoEv', 'servicioCompetColab',
            function ($scope, factoryCompetenciasColab, modalService, servicioCompetAutoEv, servicioCompetColab) {

                $scope.competencias = 0;
                $scope.idCompetencias = new Array();
                $scope.autoEvaluaciones = new Array();

                $scope.stringAutoEvaluaciones = "";
                $scope.arrayAutoEvaluacionesCompet = [];
                $scope.arrayTemporalAutoEv = new Array();

                $scope.objetoCompuesto = new Array();

                $scope.perfilCompet = "";  // aqui se guarda el id del perfil de competencia del usuario.
                $scope.userOnline = "";
                $scope.nombrePerfil = "";  // aquí se almacena el nombre del perfil de competencia
                
                $scope.arrayFinal = new Array();


                $scope.init = function () {

                    $scope.getUserOnline();
                    $scope.getPerfilCompetencia().then(function () {

                        $scope.cargar().then(function () {
                            
                            var idObj = {id: $scope.userOnline};
                            servicioCompetAutoEv.loadAutoEvaluacionesService(idObj).then(function () {

                                $scope.cargarAutoEvaluaciones();
                                $scope.loadTodo();

                            });
                        });
                    });
                };




                $scope.getUserOnline = function () {
                    servicioCompetColab.loadUsuarioId();
                    $scope.userOnline = servicioCompetColab.getUsuarioID();
                };



                $scope.getPerfilCompetencia = function () {
                    var obj = {id: $scope.userOnline};
                    return factoryCompetenciasColab.getPerfilCompetUser(obj)
                            .success(function (data, status, headers, config) {
                                $scope.perfilCompet = data.perfil.id;
                                $scope.nombrePerfil = data.perfil.nombre;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });

                };



                $scope.cargar = function () {
                    return factoryCompetenciasColab.cargarCompetenciasDePerfil($scope.perfilCompet)  // hay que fijarse cuál Perfil de Competencia tiene asociado el Colaborador
                            .success(function (data, status, headers, config) {
                                $scope.competencias = data.competencias;
                        
                                $scope.idCompetencias = new Array();
                                angular.forEach($scope.competencias, function (compet, key) {

                                    $scope.idCompetencias = $scope.idCompetencias.concat(compet.id);
                                 
                                });
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };




                $scope.confirmarAutoEvCompe = function () {
                    modalService.modalYesNo("Confirmación", "<p>" + "¿Está seguro de realizar la acción?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.guardarAutoEvComp();
                            });
                };



                $scope.guardarAutoEvComp = function () {

                    $scope.objAutoEv = new Array();
                    $scope.autoEvaluaciones = [];
                    $scope.string_AutoEv = "";  // string que contiene todas las autoevaluaciones de los detalles de la competencia.

                    // Se recorren los inputs...
                    angular.forEach($scope.idCompetencias, function (id_Elemento, key) {

                        $scope.string_auxiliar = "";
                        /*
                         Encontrar los inputs que tengan el mismo name, con lo cual corresponden a una competencia
                         en específico.
                         */
                        $scope.inputs = angular.element(document).find('input').filter(document.getElementsByName(id_Elemento));

                        /* Se recorren luego cada uno de los inputs de una competencia en específico, para obtener los valores
                         (autoevaluaciones) de los detalles. 
                         */
                        angular.forEach($scope.inputs, function (autoEv, key) {

                            (autoEv.value === "") ?
                                    $scope.autoEvaluaciones = $scope.autoEvaluaciones.concat("-")
                                    :
                                    $scope.autoEvaluaciones = $scope.autoEvaluaciones.concat(autoEv.value);
                        });

                        // Se unen las autoevaluaciones en un solo string, separados por ','
                        $scope.string_auxiliar = $scope.autoEvaluaciones.join(',');

                        // Luego se unen con las anteriores autoevaluaciones, separados por ';'         
                        $scope.string_AutoEv = $scope.string_AutoEv + $scope.string_auxiliar + ";";

                        $scope.autoEvaluaciones = new Array();

                    });

                    $scope.string_AutoEv = $scope.string_AutoEv.substr(0, $scope.string_AutoEv.length - 1);
                    
                    var obj = {value: $scope.string_AutoEv, idColab: $scope.userOnline};  // se envía el user para comprobar
                                                                                                                                              //  si ya posee autoevaluaciones o 
                                                                                                                                              //  evaluaciones

                    factoryCompetenciasColab.updateAutoEvaluacionesCompe(obj)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };




                $scope.cargarAutoEvaluaciones = function () {

                    $scope.stringAutoEvaluaciones = servicioCompetAutoEv.getStringAutoEv();
                    $scope.autoEvaluaciones = [];
                    
                    if ( $scope.stringAutoEvaluaciones !== "" && $scope.stringAutoEvaluaciones !== null ) {

                        $scope.arrayAutoEvaluacionesCompet = $scope.stringAutoEvaluaciones.split(';');

                        angular.forEach($scope.arrayAutoEvaluacionesCompet, function (elemento, key) {

                            // autoEvaluaciones contiene la lista de autoevaluaciones
                            $scope.arrayTemporalAutoEv = elemento.split(',');
                            $scope.autoEvaluaciones = $scope.autoEvaluaciones.concat($scope.arrayTemporalAutoEv);
                            $scope.arrayTemporalAutoEv = [];
                        });
                    }
                };




              $scope.loadTodo = function () {
                    var obj = {};
                    var contadorEvaluaciones = 0;

                    angular.forEach($scope.competencias, function (elemento, key) {
                        angular.forEach(elemento.detalles, function (elemento2, key2) {

                            obj = {detail: elemento2.descripcion, autoev: $scope.autoEvaluaciones[contadorEvaluaciones],
                                        idObj: elemento2.id, nameObj: elemento.id, titleCompet: elemento.titulo};
                            contadorEvaluaciones++;
                            $scope.objetoCompuesto = $scope.objetoCompuesto.concat([obj]);
                        });
                        
                        $scope.arrayFinal = $scope.arrayFinal.concat([$scope.objetoCompuesto]);
                        $scope.objetoCompuesto = [];

                    });

                };





            }]);



