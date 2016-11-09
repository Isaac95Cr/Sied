angular.module("index")
        .controller("controlEvaluarMetas", ['$scope', 'factoryMeta', 'userService', '$routeParams', 'modalService', function ($scope, factoryMeta, userService, $routeParams, modalService) {
                
        $scope.metasUser = [];
        $scope.tiene_Metas = false;
        $scope.colaborador = "";

        $scope.init = function () {
                    $scope.cargar();
                    $scope.cargarColaborador();
         };


        $scope.cargar = function () {
            var obj = {id:$routeParams.id}
                    factoryMeta.cargarMetasUser(obj)
                            .success(function (data, status, headers, config) {
                                $scope.metasUser = data.metas;
                                if ($scope.metasUser.length !== 0)
                                            $scope.tiene_Metas = true;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
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
          
          
          
             $scope.confirmarEvaluacion = function (id) {
                       modalService.modalYesNo("Confirmación", "<p>" + "¿Está seguro de realizar la acción?" + "</p>")
                               .result.then(function (selectedItem) {
                                   if (selectedItem === "si")
                                       $scope.evaluar();
                        });
             };
          
          
              $scope.evaluar = function () {
                    $scope.objEv = new Array();
                    $scope.inputs = angular.element(document).find('input');  // Obtiene todos los inputs de la página;
                    var obj;
                    // Se recorren los inputs...
                    angular.forEach($scope.inputs, function (elemento, key) {
                       (elemento.value === "") ?
                            obj = {id: elemento.id, valor: "0"}
                            :
                            obj = {id: elemento.id, valor: parseInt(elemento.value)};
                    
                        $scope.objEv.push(obj);
                    });

                    factoryMeta.updateEvaluaciones($scope.objEv)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
          
                        
}]);                

