angular.module('usuario')
        .service('autentificacionService', ['$http', 'sessionService', '$window', function ($http, sessionService, $window) {
                var autentificacion = {};
                autentificacion.login = function (obj) {
                    return $http.post('/Sied/services/usuario/login.php', obj)
                            .success(function (data, status, headers, config) {
                                sessionService.guardar(data);
                                $window.location.href = '/Sied/';
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };

                autentificacion.logout = function (obj) {
                    return $http.post('/Sied/services/usuario/logout.php', obj)
                            .success(function (data, status, headers, config) {
                                sessionService.destroy();
                                $window.location.href = '/Sied/';
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };

                autentificacion.isLog = function (obj) {
                    return $http.post('/Sied/services/usuario/session.php', obj);
                };
                autentificacion.correoContrasena = function (obj) {
                    return $http.post('/Sied/services/usuario/correo.php', obj);
                };
                autentificacion.setContrasena = function (obj) {
                    return $http.post('/Sied/services/usuario/set-contrasena.php', obj);
                };
                
                autentificacion.getNotificacion = function () {
                    return $http.get('/Sied/services/notificacion/get-notificacion.php');
                };
                autentificacion.setNotificacion = function (obj) {
                    return $http.post('/Sied/services/notificacion/set-visto.php',obj);
                };

                autentificacion.getperfil = function () {
                    //return "lola";
                    alert("create " + sessionService.userId + " " + sessionService.userName + " " + sessionService.userRole);
                    return sessionService.userId;
                };

                return autentificacion;
            }]);