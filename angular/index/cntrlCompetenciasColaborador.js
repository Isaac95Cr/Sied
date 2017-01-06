angular.module("index")
        .controller("cntrlCompetenciasColab", ['$scope', 'factoryCompetenciasColab', 'modalService', 'servicioCompetColab', function ($scope, factoryCompetenciasColab, modalService, servicioCompetColab) {

                $scope.competencias = 0;
                $scope.perfilCompet = undefined;  // aqui se guarda el id del perfil de competencia del usuario.
                $scope.userOnline = undefined;
                $scope.nombrePerfil = undefined;  // aquí se almacena el nombre del perfil de competencia
                
                $scope.tiene_Perfil = true;   // para saber si tiene un perfil asociado.
                $scope.tiene_Competencias = true;  // para saber si su perfil (en caso de tener) tiene competencias asociadas.
                $scope.tiene_Todo = false;  // para saber si tiene perfil asociado y a su vez, este competencias.

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
                            .then(function (res) {
                                if (res.status === 'error') {
                                    alert(res.message);
                                }
                                if (res.status === 'success') {
                                    $scope.perfilCompet = res.data.id;
                                    $scope.nombrePerfil = res.data.nombre;
                                    if($scope.nombrePerfil === null || $scope.nombrePerfil === undefined)
                                            $scope.tiene_Perfil = false;      // no tiene perfil asociado
                                }
                            });
                };

                $scope.cargar = function () {
                    return factoryCompetenciasColab.cargarCompetenciasDePerfil($scope.perfilCompet)
                            // hay que fijarse cuál Perfil de Competencia tiene asociado el Colaborador
                            .then(function (res) {
                                if (res.status === 'error') {
                                    alert(res.message);
                                }
                                if (res.status === 'success') {
                                    $scope.competencias = res.data;
                                    if($scope.competencias.length === 0){
                                            $scope.tiene_Competencias = false;    // no tiene competencias
                                    }
                                    if($scope.tiene_Perfil && $scope.tiene_Competencias){
                                            $scope.tiene_Todo = true;  // tiene perfil asociado y este competencias.
                                    }
                                }
                            });
                };

            }])
        .factory("factoryCompetenciasColab", function (apiConnector) {

            var competencia = {};
            var competenciasUser = new Array();

            competencia.cargarCompetenciasDePerfil = function (id) {
                var obj = {
                    id: id
                };

                return apiConnector.post("api/competencias/all", {id: id});
            };


            competencia.getPerfilCompetUser = function (obj) {

                return apiConnector.post('api/perfilCompetencias/allFromUser', obj);
            };


            competencia.guardarAutoEvCompetencias = function (id) {
                var obj = {
                };
                return apiConnector.post('api/competencias/all', obj);
            };

            competencia.updateAutoEvaluacionesCompe = function (Obj) {

                return apiConnector.post('api/evaluacionCompetencias/add', Obj);
            };


            competencia.cargarCompetenciasUser = function (id) {
                var obj = {
                    id: id
                };
                return apiConnector.post('api/competencias/all', obj);
            };



            /*Le carga al jefe las competencias y detalles de un colaborador en específico*/
            competencia.cargarDetalleCompetenciasJefe = function (obj) {

                return apiConnector.post('api/competencias/allFromUser', obj);
            };



            competencia.loadCompetenciasUser = function (colab) {

                return this.cargarDetalleCompetenciasJefe(colab).then(function (res) {
                    if (res.status === 'error') {
                        alert(res.message);
                    }
                    if (res.status === 'success') {
                        competenciasUser = res.data;
                    }
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

