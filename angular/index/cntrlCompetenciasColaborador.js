angular.module("index")
        .controller("cntrlCompetenciasColab", ['$scope', 'factoryCompetenciasColab', 'modalService', 'servicioCompetColab', function ($scope, factoryCompetenciasColab, modalService, servicioCompetColab) {

                $scope.competencias = 0;
                $scope.perfilCompet = undefined;  // aqui se guarda el id del perfil de competencia del usuario.
                $scope.userOnline = undefined;
                $scope.nombrePerfil = undefined;  // aquí se almacena el nombre del perfil de competencia

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
                        competenciasUser = data.competencias;
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

