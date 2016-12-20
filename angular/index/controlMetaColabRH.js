angular.module("index")
        .controller("controlMetaColabRH", ['$scope', 'departamentoService', 'Navigator',
            function ($scope, departamentoService, Navigator) {

                $scope.listadoDepartamentos = [];
                $scope.usersByDepartament = [];

                $scope.init = function () {
                    $scope.cargarDepartamentos();
                };
                
                

                $scope.cargarDepartamentos = function () {
                    return departamentoService.cargarConUsuarios().then(function () {
                        $scope.listadoDepartamentos = departamentoService.getDepartamentos();
                    });
                };

             
                // función que pasa el id del usuario elegido
                $scope.pasarId = function (id) {
                    Navigator.goTo('', {idUser: id});
                };


            }]);