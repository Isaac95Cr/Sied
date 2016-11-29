angular.module("index")
        .controller("cntrlCompetenciasColab", ['$scope', 'factoryCompetenciasColab', 'modalService', 'servicioCompetColab', function ($scope, factoryCompetenciasColab, modalService, servicioCompetColab) {

                $scope.competencias = 0;
                $scope.perfilCompet = "";  // aqui se guarda el id del perfil de competencia del usuario.
                $scope.userOnline = "";
                $scope.nombrePerfil = "";  // aquí se almacena el nombre del perfil de competencia

                $scope.init = function () {

                    $scope.getUserOnline();

                    $scope.getPerfilCompetencia().then(function () {

                        $scope.cargar();
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


            competencia.getPerfilCompetUser = function (obj) {

                return $http.post('/Sied/services/competencia/get-PerfilCompetUser.php', obj);
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
        .service('servicioCompetColab', ['factoryCompetenciasColab', 'sessionService', function (factoryCompetenciasColab, sessionService) {

                this.loadDetalles = function (obj) {
                    return factoryCompetenciasColab.loadCompetenciasUser(obj);
                };

                this.getCompetencias = function () {
                    return factoryCompetenciasColab.getCompetenciasUser();
                };

                this.loadUsuarioId = function () {
                    return sessionService.loadUser();
                };

                this.getUsuarioID = function () {
                    return sessionService.getUserId();
                };

            }]);

