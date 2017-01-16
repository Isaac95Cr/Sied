angular.module("index")
        .controller("controlAprobarMetasRH", ['$scope', 'factoryMeta', 'userService', 'modalService', 'tempStorage',
            'storageSession', '$crypto',
            function ($scope, factoryMeta, userService, modalService, tempStorage, storageSession, $crypto) {

                $scope.metasUser = [];
                $scope.tiene_Metas = true;
                $scope.is_Aprobar = true;  // para saber si hay metas por aprobar.
                $scope.colaborador = "";
                $scope.comentario = "";  // ng-model del comentario de la modal.

                $scope.commentIcono = "";

                $scope.metaActual = "0";  // se utiliza para saber cuál es la meta a la que se está haciendo referencia. 
                $scope.arrayComentarios = [];  // se van a guardar objetos de la forma: [{id: 1, comentario = 'comment'}]


                $scope.init = function () {
                    $scope.argumentosIdUser = tempStorage.args;

                    if ($scope.argumentosIdUser !== undefined) {
                        $scope.infoIdUser = $scope.argumentosIdUser.idUser;
                        $scope.idEncrypt = $crypto.encrypt($scope.infoIdUser);
                        storageSession.saveId($scope.idEncrypt);

                    } else {
                        $scope.infoIdUser = $crypto.decrypt(storageSession.loadId());
                    }

                    $scope.cargar();
                    $scope.cargarColaborador();
                };



                $scope.cargar = function () {
                    var obj = {id: $scope.infoIdUser};
                    factoryMeta.cargarMetasUser(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.metasUser = res.data;
                            if ($scope.metasUser.length === 0){
                                $scope.tiene_Metas = false;
                            }else{
                                $scope.is_Aprobar = 
                                        $scope.metasUser.some(elem => (elem.aprobacion_j == 1 && elem.aprobacion_rh === null));
                            }
                        }
                    });
                };


                $scope.cargarColaborador = function () {
                    userService.cargarUsuario($scope.infoIdUser).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.colaborador = res.data.usuario.nombre + " " + res.data.usuario.apellido1 + " " + res.data.usuario.apellido2;
                        }
                    });
                };


                $scope.desaprobarMeta = function () {
                    var obj = {id: $scope.metaActual, comentario: $scope.comentario};  // armar el objeto de la meta que se desaprobó

                    factoryMeta.aprobar_DesaprobarRH(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.cargar();
                            modalService.modalOk("Éxito", "<p>" + res.message + "</p>");
                            $scope.id = "0";
                            $scope.comentario = "";
                        }
                    });
                };


                $scope.comprobarAprobado = function (idCheck, meta) {
                    var input = $('#' + idCheck);
                    var estado = input[0].checked;  // determina si está checked o no

                    if (estado)
                        $scope.aprobarMeta(meta);
                    else
                        $scope.abrirModalCancel(meta);
                };



                $scope.comprobarDesaprobado = function (idCheck, meta) {
                    var input = $('#' + idCheck);
                    var estado = input[0].checked;  // determina si está checked o no

                    if (estado)
                         $scope.abrirModalCancel(meta);
                    else
                        $scope.aprobarMeta(meta);
                };



                $scope.aprobarMeta = function (meta) {

                    $scope.metaActual = meta;
                    var obj = {id: $scope.metaActual, comentario: ""};  // armar el objeto de la meta que se desaprobó

                    factoryMeta.aprobar_DesaprobarRH(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.cargar();
                            modalService.modalOk("Éxito", "<p>" + res.message + "</p>");
                            $scope.id = "0";
                            $scope.comentario = "";
                        }
                    });
                };


                $scope.abrirModalCancel = function (meta) {
                    $('#modalComent').modal();
                    $scope.metaActual = meta;
                };


                $scope.getComment = function (meta) {
                    factoryMeta.getMeta(meta).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.commentIcono = res.data[0].comentario_rh;
                            if ($scope.commentIcono === null || $scope.commentIcono === "") {
                                $scope.commentIcono = "";
                            }
                        }
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



