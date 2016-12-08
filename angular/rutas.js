angular.module("app")
        .config(['$routeProvider', function ($routeProvider) {
                $routeProvider
                        .when("/", {
                            template: "<h1>index</h1>"
                        })
                        .when("/admin_metas", {
                            templateUrl: "paginas/admin_metas.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("colaborador");
                                    }]
                            }
                        })
                        .when("/admin_competencias/", {
                            templateUrl: "paginas/admin_competencias.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("colaborador");
                                    }]
                            }
                        })
                        .when("/admin_usuarios", {
                            templateUrl: "paginas/admin_usuarios.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("RH");
                                    }]
                            }
                        })
                        .when("/admin_colaboradores_metas", {
                            templateUrl: "paginas/admin_colaboradores_metas.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("jefe");
                                    }]
                            }
                        })
                        .when("/admin_colaboradores_competencias", {
                            templateUrl: "paginas/admin_colaboradores_competencias.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("jefe");
                                    }]
                            }
                        })
                        .when("/admin_empresa", {
                            templateUrl: "paginas/admin_empresa.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("RH");
                                    }]
                            }
                        })
                        .when("/admin_periodo", {
                            templateUrl: "paginas/admin_periodo.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("RH");
                                    }]
                            }
                        })
                        .when("/admin_perfil-competencia", {
                            templateUrl: "paginas/admin_perfil-competencia.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("RH");
                                    }]
                            }
                        })
                        .when("/editar_perfil-competencia/:perfil", {
                            templateUrl: "paginas/editar_perfil-competencia.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("RH");
                                    }]
                            }
                        })
                        .when("/aprobar_metas/:id", {
//                            templateUrl: "paginas/aprobar_metas.php"
//                        .when("/aprobar_metas", {
                            templateUrl: "paginas/aprobar_metas.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("jefe");
                                    }]
                            }
                        })
                        .when("/evaluar_metas/:id", {
                            templateUrl: "paginas/evaluar_metas.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("jefe");
                                    }]
                            }
                        })
                        .when("/evaluar_competencias/:id", {
                            templateUrl: "paginas/evaluar_competencias.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("jefe");
                                    }]
                            }
                        })
                        .when("/auto-evaluar_metas", {
                            templateUrl: "paginas/auto-evaluar_metas.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("colaborador");
                                    }]
                            }
                        })
                        .when("/auto-evaluar_competencias", {
                            templateUrl: "paginas/auto-evaluar_competencias.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("colaborador");
                                    }]
                            }
                        })
                        .when("/detalleMetasJefe/:id", {
                            templateUrl: "paginas/detalleMetasJefe.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("jefe");
                                    }]
                            }
                        })
                        .when("/detalleCompetenciasJefe/:id", {
                            templateUrl: "paginas/detalleCompetenciasJefe.php",
                            resolve: {
                                access: ["sessionService", function (sessionService) {
                                        return sessionService.perfil("jefe");
                                    }]
                            }
                        })
                        .when("/perfil", {
                            templateUrl: "paginas/perfil.php"
                        })
                        .when("/notificaciones", {
                            templateUrl: "paginas/notificaciones.php"
                        })
                        .otherwise({redirectTo: '/'});
            }])
        .run(function ($window, $rootScope, autentificacionService, sessionService, $q) {
            $rootScope.$on('$locationChangeStart', function (event, next) {
                sessionService.cargar();
                var token = sessionService.token();
                if (typeof token !== "undefined") {
                    autentificacionService.isLog({token: token}).then(function (res) {
                        if (res.status === 'error') {
                            sessionService.destroy();
                            $window.location.href = 'login.php';
                        }
                    });
                } else {
                    sessionService.destroy();
                    $window.location.href = 'login.php';
                }

            });
            $rootScope.$on('$locationChangeSuccess', function (event, toState, toParams, fromState, fromParams) {
                //sessionService.cargar();
                /*if (sessionService.usuario == null) {
                 $window.location.href = 'login.php';
                 } else {*/
                //alert(toState.data.roles);
                //alert("lala");

                // }*/
            });
            $rootScope.$on("$routeChangeError", function (event, current, previous, rejection) {
                if (rejection === "noLog") {
                    sessionService.destroy();
                    $window.location.href = 'login.php';
                }
                if (rejection === "noAutorizado") {
                    $window.location.href = 'index.php';
                }
            });
        })
        .directive('sglclick', ['$parse', function ($parse) {
                return {
                    restrict: 'A',
                    link: function (scope, element, attr) {
                        var fn = $parse(attr['sglclick']);
                        var fn2 = $parse(attr['dblclick']);
                        var delay = 300, clicks = 0, timer = null;
                        element.on('click', function (event) {
                            clicks++; //count clicks
                            if (clicks === 1) {
                                timer = setTimeout(function () {
                                    scope.$apply(function () {
                                        fn(scope, {$event: event});
                                    });
                                    clicks = 0; //after action performed, reset counter
                                }, delay);
                            } else {
                                scope.$apply(function () {
                                    fn2(scope, {$event: event});
                                });
                                clearTimeout(timer); //prevent single-click action
                                clicks = 0; //after action performed, reset counter
                            }

                        });
                    }
                };
            }])
        .directive('stringToNumber', function () {
            return {
                require: 'ngModel',
                link: function (scope, element, attrs, ngModel) {
                    ngModel.$parsers.push(function (value) {
                        return '' + value;
                    });
                    ngModel.$formatters.push(function (value) {
                        return parseFloat(value);
                    });
                }
            };
        })
        .filter('toDate', function () {
            return function (dateString) {
                var dateObject = new Date(dateString);
                return dateObject;
            };
        })
        .filter('toMoment', function () {
            return function (dateString) {
                var dateObject = moment(dateString, moment.ISO_8601);
                return ""+dateObject.format("YYYY-MM-DD")+"";
            };
        });

