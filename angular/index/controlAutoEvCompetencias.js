angular.module("index")
        .controller("controlAutoEvCompetencias", ['$scope', 'factoryCompetenciasColab', 'modalService', function ($scope, factoryCompetenciasColab, modalService) {

                $scope.competencias = 0;
                $scope.idCompetencias = new Array();
                $scope.autoEvaluaciones = new Array();

                $scope.init = function () {
                    $scope.cargar();
                };

                $scope.cargar = function () {
                    factoryCompetenciasColab.cargarCompetenciasDePerfil(1)  // hay que fijarse cuál Perfil de Competencia tiene asociado el Colaborador
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
                        $scope.string_AutoEv = $scope.string_AutoEv + $scope.string_auxiliar  + ";";
                        
                        $scope.autoEvaluaciones = new Array();
                        
                    });
                    
                      $scope.string_AutoEv = $scope.string_AutoEv.substr(0, $scope.string_AutoEv.length-1);
                      var obj = {value: $scope.string_AutoEv};
                    

                    factoryCompetenciasColab.updateAutoEvaluacionesCompe(obj)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            }); 
                };

            }]);



