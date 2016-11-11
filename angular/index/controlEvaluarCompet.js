angular.module("index")
        .controller("controlEvaluarCompet", ['$scope', 'factoryCompetenciasColab', 'userService', '$routeParams', 'modalService', function ($scope, factoryCompetenciasColab, userService, $routeParams, modalService) {

                $scope.competencias = "";
                $scope.colaborador = "";
                $scope.stringAutoEvaluaciones = "";
                $scope.arrayAutoEvaluaciones = new Array();

                $scope.init = function () {
                    $scope.cargar();
                    $scope.cargarColaborador();
                };


                $scope.cargarColaborador = function () {
                    var colab = {id: $routeParams.id}
                    userService.cargarUsuario(colab)
                            .success(function (data, status, headers, config) {
                                $scope.colaborador = data.usuarios[0].nombre + " " + data.usuarios[0].apellido1 + " " + data.usuarios[0].apellido2;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };


                $scope.cargar = function () {
                    var colab = {id: $routeParams.id}
                    factoryCompetenciasColab.cargarDetalleCompetenciasJefe(colab)
                            .success(function (data, status, headers, config) {
                                $scope.competencias = data.competencias;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };




                 $scope.cargarAutoEvaluaciones = function () {

                  };


            }])
           .factory("factoryAutoEvCompetencias", function ($http) {
            var autoEv_Competencia = {};
            
            autoEv_Competencia.cargarAutoEvCompet = function (obj) {
                
                return $http.post('/Sied/services/competencia/get-AutoEvCompetencias.php',obj);
            };
            

            return autoEv_Competencia;
        });

