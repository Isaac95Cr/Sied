angular.module("index")
        .controller("controlMeta", ['$scope', 'factoryMeta', 'ShareDataService', 'modalService', function ($scope, factoryMeta, ShareDataService, modalService) {

                $scope.metas = [];
                $scope.meta = 0;

                $scope.meta_isEvaluable = 1;
                $scope.is_Check = true;

                $scope.meta_peso = 0;
                $scope.meta_titulo = "";
                $scope.meta_descripcion = "";

                $scope.actual = "0";  // se utiliza para saber cuál es la meta a la que se está haciendo referencia.
                
                $scope.auto_Evaluacion = 0;

                $scope.selectMeta = function (msg) {
                    ShareDataService.prepForBroadcast(msg);
                };


                /*
                 * Función que inicializa la lista de metas 
                 */
                $scope.init = function () {
                    $scope.cargar();
                };


                /*
                 * Función que resetea las variables
                 */
                $scope.resetValues = function () {
                    $scope.meta_isEvaluable = 1;
                    $scope.is_Check = true;

                    $scope.meta_peso = 0;
                    $scope.meta_titulo = "";
                    $scope.meta_descripcion = "";
                }


                $scope.cargar = function () {
                    factoryMeta.cargarMetas()
                            .success(function (data, status, headers, config) {
                                $scope.metas = data.meta;
                                $scope.selectMeta(data.meta[0]);
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
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
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };


                $scope.agregar = function () {
                    var metaObj = {
                        is_Evaluable: $scope.meta_isEvaluable,
                        peso: $scope.meta_peso,
                        titulo: $scope.meta_titulo,
                        descripcion: $scope.meta_descripcion
                    };

                    factoryMeta.agregarMeta(metaObj)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.meta_isEvaluable = 1;
                                $scope.is_Check = true;

                                $scope.meta_peso = 0;
                                $scope.meta_titulo = "";
                                $scope.meta_descripcion = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };




                $scope.updateActual = function (meta) {
                    $scope.actual = meta.id;

                    $scope.meta_isEvaluable = meta.evaluable;
                    ($scope.meta_isEvaluable === "1")? 
                        ($scope.is_Check = true)  :   ($scope.is_Check = false )
                        
                    $scope.meta_peso = parseInt(meta.peso);
                    $scope.meta_titulo = meta.titulo;
                    $scope.meta_descripcion = meta.descripcion;
                };




                $scope.modificar = function () {
                    var metaObj = {
                        is_Evaluable: $scope.meta_isEvaluable,
                        peso: parseInt($scope.meta_peso),
                        titulo: $scope.meta_titulo,
                        descripcion: $scope.meta_descripcion,
                        id: $scope.actual
                    };

                    factoryMeta.updateMeta(metaObj)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.meta_isEvaluable = 1;
                                $scope.is_Check = true;
                                $scope.meta_peso = 0;
                                $scope.meta_titulo = "";
                                $scope.meta_descripcion = "";
                                $scope.actual = "0";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                
                

            }])
        .factory("factoryMeta", function ($http) {
            var meta = {};

            meta.cargarMetas = function () {
                return $http.get('/Sied/services/meta/get-metas.php');
            };


            meta.agregarMeta = function (metaObj) {
                return $http.post('/Sied/services/meta/add-meta.php', metaObj);
            };


            meta.updateMeta = function (obj) {
                return $http.post('/Sied/services/meta/set-meta.php', obj);
            };

            meta.eliminarMeta = function (metaObj) {
                return $http.post('/Sied/services/meta/del-meta.php', metaObj);
            };
            
            
            meta.updateAutoEvaluaciones = function (metaObj) {
                return $http.post('/Sied/services/meta/set-autoevMetas.php', metaObj);
            };
            
            return meta;
        })
        .factory('ShareDataService', function ($rootScope) {
            var sharedService = {};

            sharedService.msg = {};

            sharedService.prepForBroadcast = function (msg) {
                this.msg = msg;
                this.broadcastItem();
            };

            sharedService.broadcastItem = function () {
                $rootScope.$broadcast('handleBroadcast');
            };

            return sharedService;
        })
        .directive('iCheck', ['$timeout', '$parse', function ($timeout, $parse) {
                return {
                    require: 'ngModel',
                    link: function ($scope, element, $attrs, ngModel) {
                        return $timeout(function () {
                            var value = $attrs.value;
                            var $element = $(element);

                            // Instantiate the iCheck control.                            
                            $element.iCheck({
                                checkboxClass: 'icheckbox_flat-blue',
                            });

                            // If the model changes, update the iCheck control.
                            $scope.$watch($attrs.ngModel, function (newValue) {
                                $element.iCheck('update');
                            });

                            // If the iCheck control changes, update the model.
                            $element.on('ifChanged', function (event) {
                                if ($element.attr('type') === 'checkbox' && $attrs.ngModel) {
                                    $scope.$apply(function () {
                                        ngModel.$setViewValue(value);
                                    });
                                }
                            });

                        });
                    }
                };
            }]);




