angular.module('usuario')
        .controller('usersColaboradoresCompetencias' , ['$scope', 'userService', 'modalService', function ($scope, userService, modalService){
                
         $scope.listaUsuarios = [];
         $scope.userID = "";
 
 
         $scope.init = function () {
                    $scope.cargar();
          };
          
          
          $scope.cargar = function () {
                    userService.cargarUsuarios()
                            .success(function (data, status, headers, config) {
                                $scope.listaUsuarios = data.usuarios;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
          };

 }]);


