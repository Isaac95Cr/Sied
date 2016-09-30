angular.module("index")
        .service('modalService', ['$uibModal', function ($modal) {
                var vm = this;
                vm.variable = {};
                vm.modal = function modal(titulo, contenido, footer, variable, funcion) {
                    $modal.open({
                        size: "sm",
                        templateUrl: 'myModalContent.html',
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
                    $modal.open({
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
                                return "<button class='btn btn-primary' ng-click='$close()' aria-label='Close'>Ok</button>"
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
        });