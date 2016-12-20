angular.module("index")
        .controller("controlEditPerfil", ['$scope', '$routeParams', 'modalService', 'ShareDataService', 'apiConnector', function ($scope, $routeParams, modalService, ShareDataService, apiConnector) {
                $scope.perfil = {};
                $scope.competencia = {};
                $scope.competenciaeditar = {};
                $scope.detalle = {};
                $scope.bandera = true;
                $scope.descripcionDetalle = "";
                $scope.descripcionDetalleEdit = "";

                $scope.descripcionCompetencia = "";
                $scope.tituloCompetencia = "";

                $scope.descripcionCompetenciaEdit = "";
                $scope.tituloCompetenciaEdit = "";

                $scope.selectCompetencia = function (id, titulo, descripcion) {

                    if ($scope.competencia.id === id) {
                        id = null;
                        titulo = null;
                        descripcion = null;
                        $scope.bandera = true;
                    } else {
                        $scope.bandera = false;
                    }
                    $scope.competencia = {id: id, titulo: titulo, descripcion: descripcion};
                };

                $scope.init = function () {
                    $scope.cargar();
                };

                $scope.isSelected = function (competencia) {
                    return competencia.id === $scope.competencia.id;
                };
                
                // Para limpiar la modal cuando se le da 'x' de cerrar o Cancelar.
                $scope.resetForm = function (form) {
                    form.$setPristine();
                    form.$setUntouched();
                };

                $scope.cargar = function () {
                    apiConnector.post("api/perfilCompetencias/all", {id: $routeParams.perfil}).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.perfil = res.data;
                            ShareDataService.prepForBroadcast(pesos());
                        }
                    });
                };

                pesos = function () {
                    var x = [];
                    $scope.perfil.competencias.forEach(function (competencia) {
                        x.push({id: competencia.id, titulo: competencia.titulo, peso: competencia.peso});
                    });
                    return {competencias: x};
                };
                $scope.modalModificarDetalle = function (detalle) {
                    $scope.descripcionDetalleEdit = detalle.descripcion;
                    $scope.detalle = detalle;
                    modalService.open("#modalDetalleEdit");
                };
                $scope.modalModificarCompetencia = function () {
                    $scope.tituloCompetenciaEdit = $scope.competencia.titulo;
                    $scope.descripcionCompetenciaEdit = $scope.competencia.descripcion;
                    modalService.open("#modalCompetenciaEdit");
                };
                $scope.modificarDetalle = function () {
                    var obj = {
                        descripcion: $scope.descripcionDetalleEdit,
                        id: $scope.detalle.id
                    };
                    apiConnector.put("api/detalleCompetencia/set", obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Modificar Detalle", "<p>" + res.message + "</p>");
                            $scope.descripcionDetalleEdit = undefined;
                            $scope.cargar();
                        }
                    });
                };
                $scope.modificarCompetencia = function () {
                    var obj = {
                        titulo: $scope.competencia.titulo,
                        descripcion: $scope.descripcionCompetenciaEdit,
                        id: $scope.competencia.id
                    };

                    apiConnector.put("api/competencias/set", obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Modificar Competencia", "<p>" + res.message + "</p>");
                            $scope.selectCompetencia(obj.id, obj.titulo, obj.descripcion);
                            $scope.cargar();
                        }
                    });
                };

                $scope.agregarDetalle = function () {

                    var obj = {
                        descripcion: $scope.descripcionDetalle,
                        competencia: $scope.competencia.id
                    };
                    apiConnector.post('api/detalleCompetencia/add', obj).then(function (res) {
                        if (res.status === 'error') {
                            return res.message;
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Agregar Detalle", "<p>" + res.message + "</p>");
                            $scope.descripcionDetalle = undefined;
                            $scope.cargar();
                            $scope.bandera = true;
                        }
                    });

                };

                $scope.agregarCompetencia = function (idForm) {

                    var obj = {
                        descripcion: $scope.descripcionCompetencia,
                        perfil: $scope.perfil.id,
                        titulo: $scope.tituloCompetencia
                    };
                    
                    apiConnector.post('api/competencias/add', obj).then(function (res) {
                        if (res.status === 'error') {
                            return res.message;
                        }
                        if (res.status === 'success') {
                             modalService.modalOk("Agregar Competencia", "<p>" +res.message + "</p>");
                                $scope.descripcionCompetencia = undefined;
                                $scope.tituloCompetencia = undefined;
                                $scope.cargar();
                                $scope.resetForm(idForm);
                        }
                    });
                  
                };
            }])