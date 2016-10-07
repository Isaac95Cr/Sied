angular.module("index", ["ngRoute", 'ui.bootstrap'])
        .config(function ($routeProvider) {
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
                    });
        });