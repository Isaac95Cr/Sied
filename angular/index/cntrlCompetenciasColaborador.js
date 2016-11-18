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
            var competenciasUser = new Array();

            competencia.cargarCompetenciasDePerfil = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/competencia/get-competencia.php', obj);
            };


            competencia.guardarAutoEvCompetencias = function (id) {
                var obj = {
                };
                return $http.post('/Sied/services/competencia/get-competencia.php', obj);
            };

            competencia.updateAutoEvaluacionesCompe = function (metaObj) {

                return $http.post('/Sied/services/competencia/set-evalCompetencias.php', metaObj);
            };


            competencia.cargarCompetenciasUser = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/competencia/get-competencia.php', obj);
            };



            /*Le carga al jefe las competencias y detalles de un colaborador en específico*/
            competencia.cargarDetalleCompetenciasJefe = function (obj) {

                return $http.post('/Sied/services/competencia/get-CompetenciasUser.php', obj);
            };



            competencia.loadCompetenciasUser = function (colab) {

                return this.cargarDetalleCompetenciasJefe(colab)
                            .success(function (data, status, headers, config) {

                                competenciasUser = data.competencias;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };


            competencia.getCompetenciasUser = function () {
                
                 return competenciasUser;
            };

            return competencia;
        })
        .service('servicioCompetColab', ['factoryCompetenciasColab', function (factoryCompetenciasColab) {

                this.loadDetalles = function (obj) {
                    return factoryCompetenciasColab.loadCompetenciasUser(obj);
                };
                
                this.getCompetencias = function () {    
                     return factoryCompetenciasColab.getCompetenciasUser();
                };

            }]);

