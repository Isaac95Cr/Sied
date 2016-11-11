angular.module("index")
        .controller("controlEvaluarCompet", ['$scope', 'factoryCompetenciasColab', 'userService', 'factoryAutoEvCompetencias', '$routeParams', 'modalService', function ($scope, factoryCompetenciasColab, userService, factoryAutoEvCompetencias, $routeParams, modalService) {

                $scope.competencias = "";
                $scope.colaborador = "";
                $scope.stringAutoEvaluaciones = "";
                $scope.arrayAutoEvaluacionesCompet = [];
                $scope.arrayTemporalAutoEv = new Array();
                $scope.arrayAutoEvaluacionesList = new Array();

                $scope.autoEvaluacion = new Array();
                $scope.autoEvaluaciones = new Array();
                $scope.CompetAutoEv = new Array();


                $scope.init = function () {
                    $scope.cargarAutoEvaluaciones();
                    $scope.cargar();
                    $scope.cargarColaborador();
                };


                $scope.cargarColaborador = function () {
                    var colab = {id: $routeParams.id}
                    userService.cargarUsuario(colab)
                            .success(function (data, status, headers, config) {
                                $scope.colaborador = data.usuarios[0].nombre + " " + data.usuarios[0].apellido1 + " " + data.usuarios[0].apellido2;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };


                $scope.cargar = function () {
                                      
                    var colab = {id: $routeParams.id}
                    factoryCompetenciasColab.cargarDetalleCompetenciasJefe(colab)
                            .success(function (data, status, headers, config) {
                                
                                $scope.competencias = data.competencias;

                                var contador = 0;  // para acceder a las posiciones del array de autoevaluaciones
                                var obj = {};
                                angular.forEach($scope.competencias, function (elemento, key) {
                                    angular.forEach(elemento.detalles, function (elementoD, keyD) {
                                        
                                        // Obj va a ser el objeto que guarda {descrip: , valor: }
                                        obj = {descrip: elementoD.descripcion, valor: $scope.arrayAutoEvaluacionesList[contador]}
                                        contador++;
                                        $scope.autoEvaluacion = $scope.autoEvaluacion.concat([obj]);
                                    });
                                    $scope.autoEvaluaciones = $scope.autoEvaluaciones.concat([$scope.autoEvaluacion]);
                                    $scope.autoEvaluacion = [];
                                });
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };




                $scope.cargarAutoEvaluaciones = function () {
                    var colab = {id: $routeParams.id}
                    factoryAutoEvCompetencias.cargarAutoEvCompet(colab)
                            .success(function (data, status, headers, config) {
                                
                                        // Obtener las autoevaluaciones (que están en un string) de manera separada
//                                if(data.autoEvaluaciones.length !== 0){
                                        $scope.stringAutoEvaluaciones = data.autoEvaluaciones[0].auto_evaluacion;
                                        $scope.arrayAutoEvaluacionesCompet = $scope.stringAutoEvaluaciones.split(';');

                                        angular.forEach($scope.arrayAutoEvaluacionesCompet, function (elemento, key) {

                                            // arrayAutoEvaluacionesList contiene la lista de autoevaluaciones
                                            $scope.arrayTemporalAutoEv = elemento.split(',');
                                            $scope.arrayAutoEvaluacionesList = $scope.arrayAutoEvaluacionesList.concat($scope.arrayTemporalAutoEv);
                                            $scope.arrayTemporalAutoEv = [];
                                        });
//                                    }

                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };


            }])
        .factory("factoryAutoEvCompetencias", function ($http) {
            var autoEv_Competencia = {};

            autoEv_Competencia.cargarAutoEvCompet = function (obj) {

                return $http.post('/Sied/services/competencia/get-AutoEvCompetencias.php', obj);
            };


            return autoEv_Competencia;
        });

