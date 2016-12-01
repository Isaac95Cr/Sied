angular.module('usuario')
        .service('userService', ['apiConnector', function (apiConnector) {
                var usuario = {};
                var nombreUser = "";

                usuario.cargarUsuarios = function () {
                    return apiConnector.get('api/usuarios/all');
                };
                usuario.cargarUsuario = function (obj) {
                    return apiConnector.post('api/usuarios/allFrom', obj);
                };

                usuario.loadAllUser = function (obj) {
                    return apiConnector.post('/Sied/services/usuario/get-AllUser.php', obj);
                };

                usuario.insert = function (obj) {
                    return apiConnector.post('api/usuarios/add', obj);
                };

                usuario.update = function (obj) {
                    return apiConnector.put('api/usuarios/set', obj);
                };


                usuario.loadUserService = function (colab) {
                    return this.loadAllUser(colab)
                            .success(function (data, status, headers, config) {
                                nombreUser = data.usuario[0].nombre + " " + data.usuario[0].apellido1 + " " + data.usuario[0].apellido2;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };


                usuario.getNameUser = function () {
                    return nombreUser;
                };

                return usuario;
            }])
        .service('servicioCompetUser', ['userService', function (userService) {

                this.loadColaborador = function (colab) {
                    return userService.loadUserService(colab);
                };

                this.getNombreUsuario = function () {
                    return  userService.getNameUser();
                };


            }]);
