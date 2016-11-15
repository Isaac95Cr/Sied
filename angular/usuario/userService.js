angular.module('usuario')
        .service('userService', function ($http) {
            var usuario = {};

            usuario.cargarUsuarios = function () {
                return $http.get('/Sied/services/usuario/get-usuario.php');
            };
            usuario.cargarUsuario = function (obj) {
                return $http.post('/Sied/services/usuario/get-usuario.php',obj);
            };
            
            usuario.insert = function(obj){
                return $http.post('/Sied/services/usuario/add-usuario.php',obj);
            };
            
            usuario.update = function(obj){
                return $http.post('/Sied/services/usuario/set-usuario.php',obj);
            };
            
            return usuario;
        });
