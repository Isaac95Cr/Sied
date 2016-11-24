angular.module("index")
        .controller("controlAprobarMetas", ['$scope', 'factoryMeta', 'userService', '$routeParams', 'modalService', function ($scope, factoryMeta, userService, $routeParams, modalService) {

                $scope.metasUser = [];
                $scope.tiene_Metas = false;
                $scope.colaborador = "";
                //$scope.aprobada = 2;
                $scope.comentario = "";  // ng-model del comentario de la modal.
                
                $scope.commentIcono = "";

                $scope.metaActual = "0";  // se utiliza para saber cuál es la meta a la que se está haciendo referencia. 
                $scope.arrayComentarios = [];  // se van a guardar objetos de la forma: [{id: 1, comentario = 'comment'}]


                $scope.init = function () {
                    $scope.cargar();
                    $scope.cargarColaborador();
                };


                $scope.cargar = function () {
                    var obj = {id: $routeParams.id}
                    factoryMeta.cargarMetasUser(obj)
                            .success(function (data, status, headers, config) {
                                $scope.metasUser = data.metas;
                                if ($scope.metasUser.length !== 0) {
                                    $scope.tiene_Metas = true;
                                }
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };


                $scope.cargarColaborador = function () {
                    userService.loadAllUser($routeParams.id)
                            .success(function (data, status, headers, config) {
                                $scope.colaborador = data.usuario[0].nombre + " " + data.usuario[0].apellido1 + " " + data.usuario[0].apellido2;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };


                $scope.desaprobarMeta = function () {
                    var obj = {id: $scope.metaActual, comentario: $scope.comentario};  // armar el objeto de la meta que se desaprobó

                    factoryMeta.aprobar_Desaprobar(obj)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.id = "0";
                                $scope.comentario = "";
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };



                $scope.aprobarMeta = function (meta) {
                    $scope.metaActual = meta;
                    var obj = {id: $scope.metaActual, comentario: ""};  // armar el objeto de la meta que se desaprobó

                    factoryMeta.aprobar_Desaprobar(obj)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.id = "0";
                                $scope.comentario = "";
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };


                $scope.abrirModalCancel = function (meta) {
                    $('#modalComent').modal();
                    $scope.metaActual = meta;
                };



                $scope.getComment = function (meta) {
                    factoryMeta.getMeta(meta)
                            .success(function (data, status, headers, config) {
                                $scope.commentIcono = data.metas[0].comentario_j;
                                if($scope.commentIcono === null || $scope.commentIcono === ""){
                                    $scope.commentIcono = "";
                                }
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };




            }])
        .directive('iCheck', ['$timeout', '$parse', function ($timeout, $parse) {
                return {
                    require: 'ngModel',
                    link: function ($scope, element, $attrs, ngModel) {
                        return $timeout(function () {
                            var value = $attrs['value'];
                            var color = $attrs['color'];
                            if (!color) {
                                color = "blue";
                            }
                            $scope.$watch($attrs['ngModel'], function (newValue) {
                                $(element).iCheck('update');
                            });

                            $scope.$watch($attrs['ngDisabled'], function (newValue) {
                                $(element).iCheck(newValue ? 'disable' : 'enable');
                                $(element).iCheck('update');
                            });

                            return $(element).iCheck({
                                checkboxClass: 'icheckbox_flat-' + color,
                                radioClass: 'iradio_minimal'
                            }).on('ifToggled', function (event) {
                                if ($(element).attr('type') === 'checkbox' && $attrs['ngModel']) {
                                    $scope.$apply(function () {
                                        return ngModel.$setViewValue(event.target.checked);
                                    });
                                }
                                if ($(element).attr('type') === 'radio' && $attrs['ngModel']) {
                                    return $scope.$apply(function () {
                                        return ngModel.$setViewValue(value);
                                    });
                                }
                            });
                        }, 300);
                    }
                };
            }]);

