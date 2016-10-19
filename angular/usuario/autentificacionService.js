angular.module('usuario')
        .service('autentificacionService', ['$http', 'sessionService', function ($http, sessionService) {
                var autentificacion = {};
                autentificacion.login = function (obj) {
                    $http.post('/Sied/services/usuario/login.php', obj)
                            .success(function (data, status, headers, config) {
                                sessionService.create(data.id, data.user.id,
                                        data.user.name, data.user.role);
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                autentificacion.logout = function (obj) {

                    sessionService.destroy();
                    autentificacion.login = function (obj) {
                        $http.post('/Sied/services/usuario/logout.php', obj)
                                .success(function (data, status, headers, config) {
                                    
                                })
                                .error(function (data, status, headers, config) {
                                    alert("failure message: " + JSON.stringify(data));
                                });
                    };
                };
                autentificacion.isAutorizado = function (obj) {
                    $http.post('/Sied/services/usuario/session.php', obj)
                            .success(function (data, status, headers, config) {
                                if (data.session === sessionService.id) {
                                    return true;
                                }
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                    return false;
                };
                autentificacion.getperfil = function () {
                    return sessionService.userRole;
                };

                return autentificacion;
            }]);