angular.module("index")
        .controller("controlEditPerfil", ['$scope', '$routeParams', 'factoryCompetencia', 'factoryperfilCompetencia', 'factoryDetalleCompetencia', 'modalService', function ($scope, $routeParams, factoryCompetencia, factoryperfilCompetencia, factoryDetalleCompetencia, modalService) {
                $scope.perfil = {};
                $scope.competencia = {};
                $scope.competenciaeditar = {};
                $scope.detalle = {};
                $scope.bandera = true;
                $scope.descripcionDetalle = "";
                $scope.descripcionDetalleEdit = "";
                
                $scope.descripcionCompetencia = "";
                $scope.tituloCompetencia = "";
                $scope.pesoCompetencia = "";
                
                $scope.descripcionCompetenciaEdit = "";
                $scope.tituloCompetenciaEdit = "";
                $scope.pesoCompetenciaEdit = "";

                $scope.selectCompetencia = function (id, titulo, descripcion) {

                    if ($scope.competencia.id === id) {
                        id = null;
                        titulo = null;
                        descripcion = null;
                        $scope.bandera = true;
                    } else {
                        $scope.bandera = false;
                    }
                    $scope.competencia = {id: id, titulo: titulo, descripcion:descripcion};
                };

                $scope.init = function () {
                    $scope.cargar();
                };

                $scope.cargar = function () {
                    factoryperfilCompetencia.cargarPerfilCompetencia($routeParams.perfil)
                            .success(function (data, status, headers, config) {
                                $scope.perfil = data.perfil;
                                $scope.selectCompetencia(data.perfil.competencias[0].id, data.perfil.competencias[0].titulo);
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
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
                    var descripcion = $scope.descripcionDetalleEdit;
                    var id = $scope.detalle.id;
                    factoryDetalleCompetencia.modificarDetalle(descripcion, id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.descripcionDetalleEdit = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };

                $scope.agregarDetalle = function () {
                    var descripcion = $scope.descripcionDetalle;
                    var competencia = $scope.competencia.id;
                    factoryDetalleCompetencia.agregarDetalle(descripcion, competencia)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.descripcionDetalle = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };

                $scope.agregarCompetencia = function () {
                    var descripcion = $scope.descripcionCompetencia;
                    var perfil = $scope.perfil.id;
                    var peso = $scope.pesoCompetencia;
                    var titulo = $scope.tituloCompetencia;
                    factoryCompetencia.agregarCompetencia(titulo, descripcion, peso, perfil)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.descripcionCompetencia = "";
                                $scope.tituloCompetencia = "";
                                $scope.pesoCompetencia = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };

            }])
        .factory("factoryCompetencia", function ($http) {
            var competencia = {};

            competencia.cargarCompetencia = function () {
                return $http.get('/Sied/services/get-competencia.php');
            };

            competencia.agregarCompetencia = function (titulo, descripcion, peso, perfil) {
                var obj = {
                    titulo: titulo,
                    descripcion: descripcion,
                    peso: peso,
                    perfil: perfil
                };
                return $http.post('/Sied/services/add-competencia.php', obj);
            };

            competencia.eliminarCompetencia = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/del-competencia.php', obj);
            };
            return competencia;
        })
        .factory("factoryDetalleCompetencia", function ($http) {
            var detalle = {};

            detalle.cargarDetalle = function () {
                return $http.get('/Sied/services/get-detalleCompetencia.php');
            };

            detalle.agregarDetalle = function (descripcion, competencia) {
                var obj = {
                    descripcion: descripcion,
                    competencia: competencia
                };
                return $http.post('/Sied/services/add-detalleCompetencia.php', obj);
            };
            
            detalle.modificarDetalle = function (descripcion, id) {
                var obj = {
                    descripcion: descripcion,
                    id: id
                };
                return $http.post('/Sied/services/set-detalleCompetencia.php', obj);
            };

            detalle.eliminarDetalle = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/del-detalleCompetencia.php', obj);
            };
            return detalle;
        });