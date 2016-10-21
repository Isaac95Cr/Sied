angular.module("index")
        .controller("cntrlCompetenciasColab", ['$scope', 'factoryCompetenciasColab', 'modalService', function ($scope, factoryCompetenciasColab, modalService) {

                $scope.competencias = 0;

                $scope.init = function () {
                    $scope.cargar();
                };

                $scope.cargar = function () {
                    factoryCompetenciasColab.cargarCompetenciasDePerfil(1)  // hay que fijarse cuál Perfil de Competencia tiene asociado el Colaborador
                            .success(function (data, status, headers, config) {
                                $scope.competencias = data.competencias;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };

            }])        
           .factory("factoryCompetenciasColab", function ($http) {
            var competencia = {};
            
            competencia.cargarCompetenciasDePerfil = function (id) {
                var obj = {
                    id:id
                };
                return $http.post('/Sied/services/competencia/get-competencia.php',obj);
            };
            
            
            competencia.guardarAutoEvCompetencias = function (id) {
                var obj = {
                };
                return $http.post('/Sied/services/competencia/get-competencia.php',obj);
            };

            return competencia;
        });

