angular.module('usuario')
        .service('userService', ['apiConnector', function (apiConnector) {
                var usuario = {};
                var nombreUser = "";
                var usuarios = [];

                usuario.cargarUsuarios = function () {
                    return apiConnector.get('api/usuarios/all');
                };
                usuario.cargarSolicitudes = function () {
                    return apiConnector.get('api/usuarios/allSolicitudes');
                };
                usuario.cargarUsuario = function (obj) {
                    return apiConnector.post('api/usuarios/allFrom', obj);
                };
                usuario.eliminar = function (obj) {
                   return apiConnector.post('api/usuarios/del',obj);
                };
                
                usuario.cargarUsuariosDeJefe = function (obj) {
                    return apiConnector.post('api/departamentos/getUsersDeJefe', obj);
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
                    return this.cargarUsuario(colab).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            nombreUser = res.data.usuario.nombre + " " + res.data.usuario.apellido1 + " " + res.data.usuario.apellido2;
                        }
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
