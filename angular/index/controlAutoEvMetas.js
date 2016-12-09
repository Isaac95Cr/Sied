angular.module("index")
        .controller("controlAutoEvMetas", ['$scope', 'factoryMeta', 'modalService', 'sessionService',
            function ($scope, factoryMeta, modalService, sessionService) {

                $scope.objAutoEv = new Array();
                $scope.metas = [];
                $scope.tiene_Metas = false;

                /*
                 * Función que inicializa la lista de metas 
                 */
                $scope.init = function () {
                    $scope.getUserOnline();
                    $scope.cargar();
                };


                $scope.getUserOnline = function () {
                    $scope.userOnline = sessionService.getUsuario();
                };



                $scope.cargar = function () {
                    var obj = {id: $scope.userOnline.id};
                    factoryMeta.cargarMetasUser(obj).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            $scope.metas = res.data;
                            if ($scope.metas.length !== 0)
                                $scope.tiene_Metas = true;
                        }
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

                    factoryMeta.updateAutoEvaluaciones($scope.objAutoEv).then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            modalService.modalOk("Éxito", "<p>" + res.message + "</p>");
                            $scope.cargar();
                        }
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






