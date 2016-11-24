angular.module("index")
        .controller("controlAutoEvMetas", ['$scope', 'factoryMeta', 'modalService', function ($scope, factoryMeta, modalService) {
                
                $scope.objAutoEv = new Array();

                /*
                 * Función que inicializa la lista de metas 
                 */
                $scope.init = function () {
                    $scope.cargar();
                };
                
                
                $scope.cargar = function () {
                    factoryMeta.cargarMetas()
                            .success(function (data, status, headers, config) {
                                $scope.metas = data.meta;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };



                $scope.autoEvaluar = function () {
                    $scope.objAutoEv = new Array();
                    $scope.inputs = angular.element(document).find('input');  // Obtiene todos los inputs de la página;
                    var obj;
                    // Se recorren los inputs...
                    angular.forEach($scope.inputs, function (elemento, key) {
                       (elemento.value === "") ?
                            obj = {id: elemento.id, valor: "0"}
                            :
                            obj = {id: elemento.id, valor: parseInt(elemento.value)};
                    
                        $scope.objAutoEv.push(obj);
                    });

                    factoryMeta.updateAutoEvaluaciones($scope.objAutoEv)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };




                $scope.confirmarAutoEv = function () {
                    modalService.modalYesNo("Confirmación", "<p>" + "¿Está seguro de realizar la acción?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.autoEvaluar();
                            });
                };

            }]);






