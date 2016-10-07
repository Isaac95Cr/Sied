angular.module("index")
        .controller("controlEmpresa", ['$scope', 'factoryEmpresa', 'ShareDataService', 'modalService', function ($scope, factoryEmpresa, ShareDataService, modalService) {

                $scope.empresas = [];
                $scope.empresa = 0;
                $scope.empresaAdd = "";
                $scope.empresaEdit = "";

                $scope.selectEmpresa = function (msg) {
                    $scope.empresa = msg;
                    ShareDataService.prepForBroadcast(msg);
                };
                $scope.init = function () {
                    $scope.cargar();
                };
                $scope.cargar = function () {
                    factoryEmpresa.cargarEmpresas()
                            .success(function (data, status, headers, config) {
                                $scope.empresas = data.empresa;
                                $scope.selectEmpresa(data.empresa[0]);
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };
                $scope.confirmar = function (id) {
                    modalService.modalYesNo("Confirmacion", "<p>" + "¿Esta seguro de realizar la accion?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.eliminar(id);
                            });
                };
                $scope.eliminar = function (id) {
                    factoryEmpresa.eliminarEmpresa(id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.modalModificar = function (empresa) {
                    $scope.selectEmpresa(empresa);
                    $scope.empresaEdit = "";
                    modalService.open("#modalEmpresaEdit");
                };
                $scope.modificar = function () {
                    var nombre = $scope.empresaEdit;
                    var id = $scope.empresa.id;
                    factoryEmpresa.modificarEmpresa(nombre, id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.empresaEdit = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.agregar = function () {
                    var nombre = $scope.empresaAdd;
                    factoryEmpresa.agregarEmpresa(nombre)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.empresaAdd = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
            }])
        .factory("factoryEmpresa", function ($http) {
            var empresa = {};

            empresa.cargarEmpresas = function () {
                return $http.get('/Sied/services/get-empresa.php');
            };

            empresa.agregarEmpresa = function (nombre) {
                var obj = {
                    nombre: nombre
                };
                return $http.post('/Sied/services/add-empresa.php', obj);
            };
            empresa.modificarEmpresa = function (nombre, id) {
                var obj = {
                    id: id,
                    nombre: nombre
                };
                return $http.post('/Sied/services/set-empresa.php', obj);
            };

            empresa.eliminarEmpresa = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/del-empresa.php', obj);
            };
            return empresa;
        })
        .factory('ShareDataService', function ($rootScope) {
            var sharedService = {};

            sharedService.msg = {};

            sharedService.prepForBroadcast = function (msg) {
                this.msg = msg;
                this.broadcastItem();
            };

            sharedService.broadcastItem = function () {
                $rootScope.$broadcast('handleBroadcast');
            };

            return sharedService;
        })
        .directive('sglclick', ['$parse', function ($parse) {
                return {
                    restrict: 'A',
                    link: function (scope, element, attr) {
                        var fn = $parse(attr['sglclick']);
                        var fn2 = $parse(attr['dblclick'])
                        var delay = 300, clicks = 0, timer = null;
                        element.on('click', function (event) {
                            clicks++; //count clicks
                            if (clicks === 1) {
                                timer = setTimeout(function () {
                                    scope.$apply(function () {
                                        fn(scope, {$event: event});
                                    });
                                    clicks = 0; //after action performed, reset counter
                                }, delay);
                            } else {
                                scope.$apply(function () {
                                    fn2(scope, {$event: event});
                                });
                                clearTimeout(timer); //prevent single-click action
                                clicks = 0; //after action performed, reset counter
                            }

                        });
                    }
                };
            }])
        .directive('closemodal', function () {
            return {
                restrict: 'A',
                link: function (scope, elem, attr, ctrl) {
                    var dialogId = '#' + attr.closemodal;
                    elem.bind('click', function (e) {
                        $(dialogId).modal('toggle');
                    });
                }
            };
        });


