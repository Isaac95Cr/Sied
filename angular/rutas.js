angular.module("app")
        .config(['$routeProvider', function ($routeProvider) {
                $routeProvider
                        .when("/", {
                            template: "<h1>index</h1>"
                        })
                        .when("/admin_metas", {
                            templateUrl: "paginas/admin_metas.php"
                        })
                        .when("/admin_competencias", {
                            templateUrl: "paginas/admin_competencias.php"
                        })
                        .when("/admin_usuarios", {
                            templateUrl: "paginas/admin_usuarios.php"
                        })
                        .when("/admin_colaboradores_metas", {
                            templateUrl: "paginas/admin_colaboradores_metas.php"
                        })
                        .when("/admin_colaboradores_competencias", {
                            templateUrl: "paginas/admin_colaboradores_competencias.php"
                        })
                        .when("/admin_empresa", {
                            templateUrl: "paginas/admin_empresa.php",
                        })
                        .when("/admin_periodo", {
                            templateUrl: "paginas/admin_periodo.php",
                        })
                        .when("/admin_perfil-competencia", {
                            templateUrl: "paginas/admin_perfil-competencia.php"
                        })
                        .when("/editar_perfil-competencia/:perfil", {
                            templateUrl: "paginas/editar_perfil-competencia.php",
                        })
                        .when("/aprobar_metas", {
                            templateUrl: "paginas/aprobar_metas.php"
                        })
                        .when("/evaluar_metas", {
                            templateUrl: "paginas/evaluar_metas.php"
                        })
                        .when("/evaluar_competencias", {
                            templateUrl: "paginas/evaluar_competencias.php"
                        })
                        .when("/auto-evaluar_metas", {
                            templateUrl: "paginas/auto-evaluar_metas.php"
                        })
                        .when("/auto-evaluar_competencias", {
                            templateUrl: "paginas/auto-evaluar_competencias.php"
                        })
                        .when("/auto-evaluar_competencias", {
                            templateUrl: "paginas/auto-evaluar_competencias.php"
                        })
                        .otherwise({redirectTo: '/'});
            }])
        .run(function ($window,$rootScope, autentificacionService, sessionService) {
            $rootScope.$on('$locationChangeStart', function (event, next) {
               /* alert(sessionService.userId);
                if (sessionService.userId == null) {
                    alert("lala");
                    //$location.href("Sied/login.php");
                  //  $window.location.href = 'login.php';
                }*/
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
        });

