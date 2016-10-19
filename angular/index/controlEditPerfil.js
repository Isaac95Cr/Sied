angular.module("index")
        .controller("controlEditPerfil", ['$scope', '$routeParams', '$location', 'factoryCompetencia', 'factoryperfilCompetencia', 'factoryDetalleCompetencia', 'modalService', 'ShareDataService', function ($scope, $routeParams, $location, factoryCompetencia, factoryperfilCompetencia, factoryDetalleCompetencia, modalService, ShareDataService) {
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

                /*$scope.$on('$locationChangeStart', function (event) {
                 /* var answer = confirm("Are you sure you want to leave this page?")
                 if (!answer) {
                 event.preventDefault();
                 }*/
                /*$timeout(function () {
                 isLeaving = true;
                 $location.path(nextUrl.substring($location.absUrl().length - $location.url().length));
                 $scope.$apply();
                 }, 1000, false);
                 ev.preventDefault();
                 //event.preventDefault();
                 
                 modalService.modalYesNo("Confirmacion", "<p>" + "¿Se aseguro de cambiar los pesos de las competencias?" + "</p>")
                 .result.then(function (selectedItem) {
                 if (selectedItem !== "si") {
                 setTimeout(function () {
                 event.preventDefault();
                 }, 1000, false);
                 }
                 });
                 
                 
                 });*/

                /* $scope.$on("$routeChangeStart", function (event, nextUrl, current) {
                 modalService.modalYesNo("Confirmacion", "<p>" + "¿Se aseguro de cambiar los pesos de las competencias?" + "</p>")
                 .result.then(function (selectedItem) {
                 if (selectedItem !== "si") {
                 setTimeout(function () {
                 event.preventDefault();
                 }, 1000, false);
                 }
                 });
                 // If I remove this line, the modal is working but the browser location changes.
                 event.preventDefault();
                 });*/

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

                $scope.cargar = function () {
                    factoryperfilCompetencia.cargarPerfilCompetencia($routeParams.perfil)
                            .success(function (data, status, headers, config) {
                                $scope.perfil = data.perfil;
                                $scope.selectCompetencia(data.perfil.competencias[0].id, data.perfil.competencias[0].titulo, data.perfil.competencias[0].descripcion);
                                ShareDataService.prepForBroadcast(pesos());
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
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
                $scope.modificarCompetencia = function () {
                    var titulo = $scope.competencia.titulo;
                    var descripcion = $scope.descripcionCompetenciaEdit;
                    var id = $scope.competencia.id;
                    factoryCompetencia.modificarCompetencia(titulo, descripcion, id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.selectCompetencia(id,titulo,descripcion);
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
                    var titulo = $scope.tituloCompetencia;
                    factoryCompetencia.agregarCompetencia(titulo, descripcion, perfil)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.descripcionCompetencia = "";
                                $scope.tituloCompetencia = "";
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
                return $http.get('/Sied/services/competencia/get-competencia.php');
            };

            competencia.agregarCompetencia = function (titulo, descripcion, perfil) {
                var obj = {
                    titulo: titulo,
                    descripcion: descripcion,
                    perfil: perfil
                };
                return $http.post('/Sied/services/competencia/add-competencia.php', obj);
            };

            competencia.modificarCompetencia = function (titulo, descripcion, id) {
                var obj = {
                    titulo: titulo,
                    descripcion: descripcion,
                    id: id
                };
                return $http.post('/Sied/services/competencia/set-competencia.php', obj);
            };
            competencia.modificarPeso = function (obj) {
                return $http.post('/Sied/services/competencia/set-pesoCompetencia.php', obj);
            };

            competencia.eliminarCompetencia = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/competencia/del-competencia.php', obj);
            };
            return competencia;
        })
        .factory("factoryDetalleCompetencia", function ($http) {
            var detalle = {};

            detalle.cargarDetalle = function () {
                return $http.get('/Sied/services/competencia/get-detalleCompetencia.php');
            };

            detalle.agregarDetalle = function (descripcion, competencia) {
                var obj = {
                    descripcion: descripcion,
                    competencia: competencia
                };
                return $http.post('/Sied/services/competencia/add-detalleCompetencia.php', obj);
            };

            detalle.modificarDetalle = function (descripcion, id) {
                var obj = {
                    descripcion: descripcion,
                    id: id
                };
                return $http.post('/Sied/services/competencia/set-detalleCompetencia.php', obj);
            };

            detalle.eliminarDetalle = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/competencia/del-detalleCompetencia.php', obj);
            };
            return detalle;
        });