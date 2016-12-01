angular.module('usuario')
        .service('autentificacionService', ['apiConnector', 'sessionService', '$window', function (apiConnector, sessionService, $window) {
                var autentificacion = {};
                autentificacion.login = function (obj) {
                    return apiConnector.put('api/usuarios/login', obj)
                            .then(function (res) {
                                if (res.status === 'error') {
                                    alert(res.message);
                                }
                                if (res.status === 'success') {
                                    sessionService.guardar(res.data);
                                    $window.location.href = '/Sied/';
                                }
                            });
                };

                autentificacion.logout = function (obj) {
                    return apiConnector.put('api/usuarios/logout', obj).then(function(res) {
                        sessionService.destroy();
                        $window.location.href = 'login.php';
                    });
                };

                autentificacion.isLog = function (obj) {
                    return apiConnector.post('api/usuarios/session', obj);
                };
                autentificacion.correoContrasena = function (obj) {
                    return apiConnector.post('/Sied/services/usuario/correo.php', obj);
                };
                autentificacion.setContrasena = function (obj) {
                    return apiConnector.post('/Sied/services/usuario/set-contrasena.php', obj);
                };

                autentificacion.getNotificacion = function (obj) {
                    return apiConnector.post('api/notificaciones/all', obj);
                };
                autentificacion.setNotificacion = function (obj) {
                    return apiConnector.put('api/notificaciones/set', obj);
                };

                autentificacion.getperfil = function () {
                    //return "lola";
                    alert("create " + sessionService.userId + " " + sessionService.userName + " " + sessionService.userRole);
                    return sessionService.userId;
                };

                return autentificacion;
            }]);