angular.module("index")
        .controller("controlEvaluarCompet", ['$scope', 'userService', 'factoryCompetenciasColab',
            'factoryAutoEvCompetencias', '$routeParams', 'servicioCompetColab', 'servicioCompetAutoEv',
            'servicioCompetUser', 'modalService', function ($scope, userService, factoryCompetenciasColab,
                    factoryAutoEvCompetencias, $routeParams,
                    servicioCompetColab, servicioCompetAutoEv,
                    servicioCompetUser, modalService) {

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

                var colab = {id: $routeParams.id}


                $scope.init = function () {

                    // Primero se solicitan las autoevaluaciones al servidor, después se cargan en los scopes.
                    // Luego se solicitan los detalles de competencia, después se cargan en los scopes los
                    // detalles y sus respectivas autoevaluaciones.

                    servicioCompetAutoEv.loadAutoEvaluacionesService(colab).then(function () {

                        $scope.cargarAutoEvaluaciones();   // se cargan en los scopes las autoevaluaciones
                        $scope.cargarEvaluaciones();  // se cargan en los scopes las evaluaciones

                    }).then(function () {

                        return servicioCompetColab.loadDetalles(colab)

                    }).then(function () {

                        $scope.cargarDetalles_AutoEval();   // se cargan en los scopes detalles y sus respectivas autoevaluaciones

                    }).then(function () {

                        return servicioCompetUser.loadColaborador($routeParams.id);

                    }).then(function () {

                        $scope.cargarColaborador();
                    });
                    

                };



                $scope.cargarColaborador = function () {
                    $scope.colaborador = servicioCompetUser.getNombreUsuario();
                };


                $scope.cargarDetalles_AutoEval = function () {
                    $scope.competencias = servicioCompetColab.getCompetencias();
                    var contador = 0;  // para acceder a las posiciones del array de autoevaluaciones y de evaluaciones
                    var obj = {};
                    angular.forEach($scope.competencias, function (elemento, key) {
                        angular.forEach(elemento.detalles, function (elementoD, keyD) {
                            
                            // Hay que verificar si están las autoevaluaciones y las evaluaciones...
                            
                                 if ($scope.arrayAutoEvaluacionesList[contador] !== undefined){
                                     if($scope.arrayEvaluaciones[contador] !== undefined)
                                            obj = {descrip: elementoD.descripcion, valor: $scope.arrayAutoEvaluacionesList[contador],
                                                        valor2: $scope.arrayEvaluaciones[contador]};
                                       else
                                            obj = {descrip: elementoD.descripcion, valor: $scope.arrayAutoEvaluacionesList[contador],
                                                        valor2: "0"};
                                  }
                                       
                                else if($scope.arrayEvaluaciones[contador] !== undefined){
                                       obj = {descrip: elementoD.descripcion, valor: "-", valor2: $scope.arrayEvaluaciones[contador]};
                                 }
                                 else{
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
                    if ($scope.stringAutoEvaluaciones !== "") {

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
                    if (evaluacionesString !== "" && evaluacionesString !== null)
                        $scope.arrayEvaluaciones = evaluacionesString.split(',');

                }



                $scope.confirmarEvaluacion = function (id) {
                    modalService.modalYesNo("Confirmación", "<p>" + "¿Está seguro de realizar la acción?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.evaluar();
                            });
                };







                // Guardar Evaluaciones de Detalles de Competencias
                $scope.evaluar = function () {
                    $scope.inputs = angular.element(document).find('input');  // Obtiene todos los inputs de la página;
                    var obj;
                    var idDetalles = servicioCompetAutoEv.getIDAutoEv();  // id de las evaluaciones en la bd.
                    var stringEvaluaciones = "";

                    // Se recorren los inputs...
                    angular.forEach($scope.inputs, function (elemento, key) {
                        (elemento.value === "") ?
                                stringEvaluaciones = stringEvaluaciones + "0,"
                                :
                                stringEvaluaciones = stringEvaluaciones + elemento.value + ",";

                    });

                    stringEvaluaciones = stringEvaluaciones.substr(0, stringEvaluaciones.length - 1);
                    obj = {id: idDetalles, evaluaciones: stringEvaluaciones, idColab: colab.id};

                    servicioCompetAutoEv.actualizarEvaluacionesDetalles(obj)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                // $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });

                };





            }])
        .factory("factoryAutoEvCompetencias", function ($http) {

            var autoEv_Competencia = {};
            var stringAutoEv = "";  // se recibe el string de las autoevaluaciones
            var stringEvaluaciones = "";   // se recibe el string de las evaluaciones
            var IDAutoevaluaciones = "";   // aquí se guarda el id de la base de datos correspondiente a las autoevaluaciones 
            // de competencias.

            autoEv_Competencia.cargarAutoEvCompet = function (obj) {
                return $http.post('/Sied/services/competencia/get-AutoEvCompetencias.php', obj);
            };


            autoEv_Competencia.updateEvaluacionesDetalles = function (obj) {
                return $http.post('/Sied/services/competencia/set-evaluacionDetalle.php', obj);
            };

            autoEv_Competencia.getIdBD = function () {
                return IDAutoevaluaciones;
            };


            autoEv_Competencia.loadAutoEvaluacionesCompet = function (colab) {
                return this.cargarAutoEvCompet(colab)
                        .success(function (data, status, headers, config) {
                            // Obtener las autoevaluaciones (que están en un string) de manera separada
                            var tamanoData = data.autoEvaluaciones.length;
                            stringAutoEv = "";
                            if (tamanoData !== 0) {
                                stringAutoEv = data.autoEvaluaciones[0].auto_evaluacion;
                                stringEvaluaciones = data.autoEvaluaciones[0].evaluacion;
                                IDAutoevaluaciones = data.autoEvaluaciones[0].id;
                            }
                        })
                        .error(function (data, status, headers, config) {
                            alert("failure message: " + JSON.stringify(headers));
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

            }]);

