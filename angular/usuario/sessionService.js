angular.module('usuario')
        .service('sessionService', ['$sessionStorage',"$q", function ($sessionStorage,$q) {
                var session = {
                    carga: false,
                    usuario: undefined
                };
                
                var usuarioOnline = "";

                session.guardar = function (token) {
                    token = token.replace(/^\s+|\s+$/g, '');
                    $sessionStorage.session = (token);
                };

                session.cargar = function () {
                    var token = $sessionStorage.session;
                    var user;
                    if (token !== "undefined") {
                        user = this.getUserFromToken(token);
                        this.usuario = user.user;
                        this.carga = true;
                    } else {
                        this.usuario = "undefined";
                    }
                    return user;
                };

                session.token = function () {
                    return $sessionStorage.session;
                };

                session.destroy = function () {
                    delete $sessionStorage.session;
                };

                session.getUsuario = function () {
                    if (!session.carga)
                        session.cargar();
                    return this.usuario;
                };
                
                
                session.loadUser = function () {
                      usuarioOnline = this.getUsuario().id;
                };
                
                
                session.getUserId = function () {
                    return usuarioOnline;
                }

                session.permisos = function () {
                    if (!session.carga)
                        session.cargar();
                    return this.usuario.perfil;
                };
                
                session.perfil = function(permiso){
                    var user = session.permisos();
                    if(user[permiso] === "0")
                      return  $q.reject("noAutorizado");    
                };

                function urlBase64Decode(str) {
                    var output = str.replace('-', '+').replace('_', '/');
                    switch (output.length % 4) {
                        case 0:
                            break;
                        case 2:
                            output += '==';
                            break;
                        case 3:
                            output += '=';
                            break;
                        default:
                            throw 'Illegal base64url string!';
                    }
                    return window.atob(output);
                }

                session.getUserFromToken = function (token) {
                    var user = {};
                    if (typeof token !== 'undefined') {
                        var encoded = token.split('.')[1];
                        user = JSON.parse(urlBase64Decode(encoded));
                    }
                    return user;
                };

                return session;
            }]);