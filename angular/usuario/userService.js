angular.module('usuario')
        .service('userService', function ($http) {
            var usuario = {};
            var nombreUser = "";

            usuario.cargarUsuarios = function () {
                return $http.get('/Sied/services/usuario/get-usuario.php');
            };
            usuario.cargarUsuario = function (obj) {
                return $http.post('/Sied/services/usuario/get-usuario.php', obj);
            };

            usuario.insert = function (obj) {
                return $http.post('/Sied/services/usuario/add-usuario.php', obj);
            };

            usuario.update = function (obj) {
                return $http.post('/Sied/services/usuario/set-usuario.php', obj);
            };
            
            
            usuario.loadUserService = function (colab) {
                    return this.cargarUsuario(colab)
                            .success(function (data, status, headers, config) {
                                nombreUser = data.usuarios[0].nombre + " " + data.usuarios[0].apellido1 + " " + data.usuarios[0].apellido2;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
             };
             
             
             usuario.getNameUser = function (){
                 return nombreUser;
             }

            return usuario;
        })
        .service('servicioCompetUser', ['userService', function (userService) {

           this.loadColaborador = function (colab) {
               return userService.loadUserService(colab);
           };
           
           this.getNombreUsuario  = function (){
               return  userService.getNameUser();
           };
           

        }]);
