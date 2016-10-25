angular.module('usuario')
        .service('autentificacionService', ['$http', 'sessionService', '$window', function ($http, sessionService, $window) {
                var autentificacion = {};
                autentificacion.login = function (obj) {
                    $http.post('/Sied/services/usuario/login.php', obj)
                            .success(function (data, status, headers, config) {
                                //sessionService.create(data.id, data.user.id,
                               //         data.user.nombre, data.user.perfil);
                                $window.location.href = '/Sied/';
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };

                autentificacion.logout = function (obj) {
                    $http.post('/Sied/services/usuario/logout.php', obj)
                            .success(function (data, status, headers, config) {
                               // sessionService.destroy();
                               // $window.location.href = '/Sied/';
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
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
                    //return "lola";
                    alert("create " + sessionService.userId + " " + sessionService.userName + " " + sessionService.userRole);
                    return sessionService.userId;
                };

                return autentificacion;
            }]);