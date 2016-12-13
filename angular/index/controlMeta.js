angular.module("index")
        .controller("controlMeta", ['$scope', 'factoryMeta', 'modalService', 'sessionService', 'ShareDataService', '$rootScope',
            function ($scope, factoryMeta, modalService, sessionService, ShareDataService, $rootScope) {

                $scope.metas = [];
                $scope.tiene_Metas = false;
                $scope.meta = 0;

                $scope.meta_isEvaluable = 1;
                $scope.is_Check = true;

                $scope.meta_titulo = "";
                $scope.meta_descripcion = "";

                $scope.actual = "0";  // se utiliza para saber cuál es la meta a la que se está haciendo referencia.

                $scope.auto_Evaluacion = 0;
                $scope.userOnline = [];

                /*
                 * Función que inicializa la lista de metas 
                 */
                $scope.init = function () {
                    $scope.getUserOnline();
                    $scope.cargar();
                };


                $scope.getUserOnline = function () {
                    $scope.userOnline = sessionService.getUsuario();
                };


                /*
                 * Función que resetea las variables
                 */
                $scope.resetValues = function () {
                    $scope.meta_isEvaluable = 1;
                    $scope.is_Check = true;
                    $scope.meta_titulo = "";
                    $scope.meta_descripcion = "";
                };


                $rootScope.$on("CallParentMethod", function () {
                    $scope.cargar();
                });


                $scope.cargar = function () {
                    var obj = {id: $scope.userOnline.id};
                    $scope.tiene_Metas = false;

                    factoryMeta.cargarMetasUser(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.metas = res.data;
                            if ($scope.metas.length !== 0)
                                $scope.tiene_Metas = true;
                            ShareDataService.prepForBroadcast(pesos());
                        }
                    });
                };



                $('input').on('ifUnchecked', function () {
                    $scope.meta_isEvaluable = 0;
                    $scope.is_Check = false;

                });

                $('input').on('ifChecked', function () {
                    $scope.meta_isEvaluable = 1;
                    $scope.is_Check = true;
                });


                $scope.confirmarEliminacion = function (id) {
                    modalService.modalYesNo("Confirmación", "<p>" + "¿Está seguro de realizar la acción?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.eliminar(id);
                            });
                };

                $scope.eliminar = function (idParam) {

                    var metaObj = {
                        id: idParam
                    };
                    factoryMeta.eliminarMeta(metaObj)
                            .then(function (res) {
                                if (res.status === 'error') {
                                    alert(res.message);
                                }
                                if (res.status === 'success') {
                                    $scope.cargar();
                                    modalService.modalOk("Éxito", "<p>" + res.message + "</p>")
                                            .result.then(function () {
                                                modalService.modalOk("Aviso", "<p>¡Debe recalcular los pesos de las metas!</p>")
                                                        .result.then(function () {
                                                            angular.element(document.querySelector('#modalPeso')).modal();  // para abrir la modal de los pesos
                                                        });
                                            });
                                }
                            });
                };

                $scope.agregar = function () {
                    var metaObj = {
                        is_Evaluable: $scope.meta_isEvaluable,
                        peso: '0',
                        titulo: $scope.meta_titulo,
                        descripcion: $scope.meta_descripcion,
                        usuario: $scope.userOnline.id
                    };

                    factoryMeta.agregarMeta(metaObj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Éxito", "<p>" + res.message + "</p>");
                            $scope.meta_isEvaluable = 1;
                            $scope.is_Check = true;
                            $scope.meta_peso = 0;
                            $scope.meta_titulo = undefined;
                            $scope.meta_descripcion = undefined;
                            $scope.cargar();
                        }
                    });

                };




                $scope.updateActual = function (meta) {
                    $scope.actual = meta.id;

                    $scope.meta_isEvaluable = meta.evaluable;
                    ($scope.meta_isEvaluable === "1") ?
                            ($scope.is_Check = true) : ($scope.is_Check = false);

                    $scope.meta_titulo = meta.titulo;
                    $scope.meta_descripcion = meta.descripcion;
                };




                $scope.modificar = function () {
                    var metaObj = {
                        is_Evaluable: $scope.meta_isEvaluable,
                        titulo: $scope.meta_titulo,
                        descripcion: $scope.meta_descripcion,
                        id: $scope.actual
                    };

                    factoryMeta.updateMeta(metaObj)
                            .then(function (res) {
                                if (res.status === 'error') {
                                    alert(res.message);
                                }
                                if (res.status === 'success') {
                                    modalService.modalOk("Éxito", "<p>" + res.message + "</p>");
                                    $scope.meta_isEvaluable = 1;
                                    $scope.is_Check = true;
                                    $scope.meta_titulo = undefined;
                                    $scope.meta_descripcion = undefined;
                                    $scope.actual = "0";
                                    $scope.cargar();
                                }
                            });
                };



                pesos = function () {
                    var x = [];
                    $scope.metas.forEach(function (meta) {
                        x.push({id: meta.id, titulo: meta.titulo, peso: meta.peso});
                    });
                    return {metas: x};
                };



            }])
        .factory("factoryMeta", function (apiConnector) {
            var meta = {};

            meta.cargarMetas = function () {
                return apiConnector.get('api/metas/all');
            };


            meta.cargarMetasUser = function (obj) {
                return apiConnector.post('api/metas/all', obj);
            };


            meta.agregarMeta = function (metaObj) {
                return apiConnector.post('api/metas/add', metaObj);
            };


            meta.updateMeta = function (obj) {
                return apiConnector.put('api/metas/set', obj);
            };

            meta.eliminarMeta = function (metaObj) {
                return apiConnector.post('api/metas/del', metaObj);
            };


            meta.updateAutoEvaluaciones = function (metaObj) {
                return apiConnector.put('api/metas/setAuto', metaObj);
            };


            meta.updateEvaluaciones = function (metaObj) {
                return apiConnector.put('api/metas/setEvaluacion', metaObj);
            };

            meta.aprobar_Desaprobar = function (metaObj) {
                return apiConnector.put('api/metas/aprobarMeta', metaObj);
            };

            meta.getMeta = function (obj) {
                return apiConnector.post('api/metas/allFrom', obj);
            };


            meta.modificarPeso = function (obj) {
                return apiConnector.put('api/metas/setPeso', obj);
            };


            return meta;

        });



