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

            }])
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