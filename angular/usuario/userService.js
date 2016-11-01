angular.module('usuario')
        .service('userService', function ($http) {
            var usuario = {};

            usuario.cargarUsuarios = function () {
                return $http.get('/Sied/services/usuario/get-usuario.php');
            };
            usuario.cargarUsuario = function (obj) {
               /* var obj = {
                    id:id
                };*/
                return $http.post('/Sied/services/usuario/get-usuario.php',obj);
            };
            usuario.insert = function(obj){
                return $http.post('/Sied/services/usuario/add-usuario.php',obj);
            };
            
            return usuario;
        });