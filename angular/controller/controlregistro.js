angular.module("registro", [])
        .controller("controlregistro", function ($scope, $http) {
            var vm = this;
                $scope.cedula = "";
                $scope.nombre="";
                $scope.apellido1="";
                $scope.apellido2="";
                $scope.correo="";
                $scope.contrasena="";
                
            $scope.agregarUsuario = function () {
                var userObj = {
                    id: $scope.cedula,
                    nombre: $scope.nombre,
                    apellido1: $scope.apellido1,
                    apellido2: $scope.apellido2,
                    correo: $scope.correo,
                    contrasena: $scope.contrasena
                    
                };
                $scope.message= ""+userObj.id+" "+ userObj.nombre;
                
                var res = $http.post('/Sied/services/agregar-usuario.php',userObj);
                res.success(function(data, status, headers, config) {
			$scope.message = data;
                        alert(data);
		});
		res.error(function(data, status, headers, config) {
			alert( "failure message: " + JSON.stringify(headers));
		});
                
            };



        });
