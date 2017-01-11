angular.module('usuario')
        .service('autentificacionService', ['apiConnector', 'sessionService', '$window',
                       function (apiConnector, sessionService, $window) {
                var autentificacion = {};
                autentificacion.login = function (obj) {
                    return apiConnector.put('api/usuarios/login', obj)
                            .then(function (res) {
                                if (res.status === 'error') {
                                   return res.message;
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
                
                
                
                autentificacion.logoutAndSetPassword = function (objUser) {
                     var obj = {token:sessionService.token()};
                     return apiConnector.put('api/usuarios/cambiarPasswordUser', objUser)
                      .then( function() { 
                         return apiConnector.put('api/usuarios/logout', obj); 
                         }).then(function() {
                            sessionService.destroy();
                            $window.location.href = 'login.php';
                        }); 
                };
                

                autentificacion.isLog = function (obj) {
                    return apiConnector.post('api/usuarios/session', obj);
                };
                autentificacion.correoContrasena = function (obj) {
                    return apiConnector.post('api/usuarios/correo', obj);
                };
                autentificacion.setContrasena = function (obj) {
                    return apiConnector.put('api/usuarios/setP', obj);
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