angular.module("index")
        .controller("controlAutoEvCompetencias", ['$scope', 'factoryCompetenciasColab', 'modalService', function ($scope, factoryCompetenciasColab, modalService) {

                $scope.objAutoEv = new Array();
                $scope.competencias = 0;
                $scope.idCompetencias = new Array();

                $scope.init = function () {
                    $scope.cargar();
                };

                $scope.cargar = function () {
                    factoryCompetenciasColab.cargarCompetenciasDePerfil(1)  // hay que fijarse cuál Perfil de Competencia tiene asociado el Colaborador
                            .success(function (data, status, headers, config) {
                                $scope.competencias = data.competencias;

                                angular.forEach($scope.competencias, function (compet, key) {

                                    $scope.idCompetencias.push(compet.id);
                                });
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };


                $scope.guardarAutoEvComp = function () {
                    //$scope.objAutoEv = new Array();
                    //$scope.string_Id = "";
                    // Se recorren los inputs...
                    //angular.forEach($scope.idCompetencias, function (id_Elemento, key) {
                                 /* 
                                  * Encontrar los inputs que tengan el mismo name, con lo cual corresponden a una competencia
                                    en específico.
                                 */
                             //$scope.inputs = angular.element(document).find('input').filter(document.getElementsByName(id_Elemento));
                             
                                 
                    //});
                    
                      //var obj = {id: string};
                      //$scope.objAutoEv.push(obj);

                    /*factoryCompetenciasColab.updateAutoEvaluaciones($scope.objAutoEv)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            }); */
                };

            }]);



