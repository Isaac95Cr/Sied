angular.module("index")
        .service('modalService', ['$uibModal', function ($modal) {
                var vm = this;
                vm.variable = {};
                vm.modal = function modal(url, titulo, contenido, footer, variable, funcion) {
                    return $modal.open({
                        size: "sm",
                        templateUrl: url,
                        controller: ['$uibModalInstance', 'titulo', 'contenido', 'footer', 'variable', funcion],
                        controllerAs: 'vm',
                        resolve: {
                            titulo: function () {
                                return titulo;
                            },
                            contenido: function () {
                                return contenido;
                            },
                            footer: function () {
                                return footer;
                            },
                            variable: function () {
                                return variable;
                            }
                        }
                    });
                };
                vm.modalOk = function modalOk(titulo, contenido, variable) {
                    return $modal.open({
                        size: "sm",
                        templateUrl: 'myModalContent.html',
                        controller: ['$uibModalInstance', 'titulo', 'contenido', 'footer', 'variable', modalOkcontroller],
                        controllerAs: 'vm',
                        resolve: {
                            titulo: function () {
                                return titulo;
                            },
                            contenido: function () {
                                return contenido;
                            },
                            footer: function () {
                                return "<button class='btn btn-primary' ng-click='$close()' aria-label='Close'>Ok</button>";
                            },
                            variable: function () {
                                return variable;
                            }
                        }
                    });
                };
                modalOkcontroller = function ($uibModalInstance, titulo, contenido, footer, variable) {
                    var vm = this;
                    vm.titulo = titulo;
                    vm.contenido = contenido;
                    vm.variable = variable;
                    vm.footer = footer;
                    vm.ok = function () {
                        $uibModalInstance.close('si');
                    };
                    vm.cancel = function () {
                        $uibModalInstance.dismiss('cancel');
                    };
                };
                vm.modalYesNo = function modalYesNo(titulo, contenido, variable) {
                    return $modal.open({
                        size: "sm",
                        templateUrl: 'myModalContent.html',
                        controller: ['$uibModalInstance', 'titulo', 'contenido', 'footer', 'variable', modalOkcontroller],
                        controllerAs: 'vm',
                        resolve: {
                            titulo: function () {
                                return titulo;
                            },
                            contenido: function () {
                                return contenido;
                            },
                            footer: function () {
                                return "<button class='btn btn-primary pull-rigth' ng-click='vm.ok()' aria-label='Close'>Si</button>" +
                                        "<button class='btn btn-default pull-left' ng-click='vm.cancel()' aria-label='Close'>Cancel</button>";
                            },
                            variable: function () {
                                return variable;
                            }
                        }
                    });
                };
                vm.modalEdit = function modalEdit(titulo, contenido, fotter, variable) {
                    return $modal.open({
                        size: "md",
                        templateUrl: 'myModalContent.html',
                        controller: ['$uibModalInstance', 'titulo', 'contenido', 'footer', 'variable', modalOkcontroller],
                        controllerAs: 'vm',
                        resolve: {
                            titulo: function () {
                                return titulo;
                            },
                            contenido: function () {
                                return contenido;
                            },
                            footer: function () {
                                return fotter;
                            },
                            variable: function () {
                                return variable;
                            }
                        }
                    });
                };
                vm.open = function (elementId) {
                   return $(elementId).modal('show');
                };
            }

        ])
        .directive('compileData', function ($compile) {
            return {
                scope: true,
                link: function (scope, element, attrs) {

                    var elmnt;

                    attrs.$observe('template', function (myTemplate) {
                        if (angular.isDefined(myTemplate)) {
                            // compile the provided template against the current scope
                            elmnt = $compile(myTemplate)(scope);
                            element.html(""); // dummy "clear"
                            element.append(elmnt);
                        }
                    });
                }
            };
        })
        .directive('closemodal', function () {
            return {
                restrict: 'A',
                link: function (scope, elem, attr, ctrl) {
                    var dialogId = '#' + attr.closemodal;
                    elem.bind('click', function (e) {
                        $(dialogId).modal('toggle');
                    });
                }
            };
        });