angular.module('usuario')
        .service('userService', function ($http) {
            var usuario = {};

            usuario.cargarUsuarios = function () {
                return $http.get('/Sied/services/usuario/get-usuarios.php');
            };
            usuario.cargarUsuarios = function (obj) {
               /* var obj = {
                    id:id
                };*/
                return $http.post('/Sied/services/usuario/get-usuarios.php',obj);
            };
            usuario.insert = function(obj){
                return $http.post('/Sied/services/usuario/add-usuario.php',obj);
            };
            
            return usuario;
        });