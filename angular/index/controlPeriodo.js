angular.module('index')
        .controller('controlPeriodo', ['$scope', 'apiConnector', 'ShareDataService', 'modalService', function ($scope, apiConnector, ShareDataService, modalService) {

                $scope.periodos = [];
                $scope.periodo = {};
                $scope.periodoActual = {};
                $scope.model = {
                    date1: {
                        startDate: undefined,
                        endDate: undefined
                    },
                    date2: {
                        startDate: undefined,
                        endDate: undefined
                    },
                    date3: {
                        startDate: undefined,
                        endDate: undefined
                    },
                    nombre: undefined,
                    id: undefined
                };
                $scope.addBool = false;
                $scope.setBool = false;
                $scope.init = function () {
                    $scope.cargar();
                };
                $scope.cargar = function () {
                    apiConnector.get('api/periodos/get').then(function (res) {
                        if (res.status == "success") {
                            $scope.setPeriodoActual(res.data);
                            $scope.setPeriodo(res.data);
                        }
                    });
                    apiConnector.get('api/periodos/getAll').then(function (res) {
                        if (res.status == "success") {
                            $scope.periodos = res.data;
                        }
                    });
                };

                $scope.verPeriodo = function (periodo) {
                    $scope.setPeriodo(periodo);
                };
                $scope.isIdActual = function (id) {
                    return id === $scope.periodoActual.id;
                };
                $scope.isSelected = function (id) {
                    return id === $scope.periodo.id;
                };
                $scope.isPeriodoActual = function () {
                    if ($scope.periodo.id !== undefined && $scope.periodoActual.id !== undefined)
                        return $scope.periodo.id === $scope.periodoActual.id;
                    else
                        return false;
                };
                $scope.agregarPeriodo = function () {
                    $scope.addBool = true;
                };
                $scope.modificarPeriodo = function () {
                    $scope.setBool = true;
                    $scope.setModelo($scope.periodo);
                };
                $scope.cancelar = function () {
                    $scope.addBool = false;
                    $scope.setBool = false;
                    $scope.perABool = false;
                    $scope.setModel();
                };
                $scope.setModel = function () {
                    $scope.model = {
                        date1: {
                            startDate: undefined,
                            endDate: undefined
                        },
                        date2: {
                            startDate: undefined,
                            endDate: undefined
                        },
                        date3: {
                            startDate: undefined,
                            endDate: undefined
                        },
                        nombre: undefined,
                        id: undefined
                    };
                };
                
                $scope.setModelo = function (periodo) {
                    $scope.model = {
                        nombre: periodo.nombre,
                        id: periodo.id,
                        date1: {
                            startDate: periodo.date1.startDate,
                            endDate: periodo.date1.endDate
                        },
                        date2: {
                            startDate: periodo.date2.startDate,
                            endDate: periodo.date2.endDate
                        },
                        date3: {
                            startDate: periodo.date3.startDate,
                            endDate: periodo.date3.endDate
                        }
                    };
                };

                $scope.setPeriodo = function (periodo) {

                    $scope.periodo = {
                        nombre: periodo.nombre,
                        id: periodo.id,
                        date1: {
                            startDate: periodo.fechainicio,
                            endDate: periodo.fechafinal
                        },
                        date2: {
                            startDate: periodo.fiper1,
                            endDate: periodo.ffper1
                        },
                        date3: {
                            startDate: periodo.fiper2,
                            endDate: periodo.ffper2
                        }
                    };
                    ShareDataService.prepForBroadcast(periodo.id);
                };
                $scope.setPeriodoActual = function (periodo) {

                    $scope.periodoActual = {
                        nombre: periodo.nombre,
                        id: periodo.id,
                        date1: {
                            startDate: periodo.fechainicio,
                            endDate: periodo.fechafinal
                        },
                        date2: {
                            startDate: periodo.fiper1,
                            endDate: periodo.ffper1
                        },
                        date3: {
                            startDate: periodo.fiper2,
                            endDate: periodo.ffper2
                        }
                    };
                };

                $scope.agregar = function () {
                    apiConnector.post('api/periodos/add', $scope.model).then(function (res) {
                        if (res.status === "success") {
                            $scope.cancelar();
                            $scope.cargar();
                        }
                    });
                };
                
                $scope.modificar = function () {
                    apiConnector.post('api/periodos/set', $scope.model).then(function (res) {
                        if (res.status === "success") {
                            $scope.cancelar();
                            $scope.cargar();
                        }
                    });
                };

                $scope.validar = function () {
                    
                    return moment($scope.model.date2.startDate).isSameOrAfter($scope.model.date1.startDate)
                            && moment($scope.model.date3.startDate).isSameOrAfter($scope.model.date2.endDate)
                            && moment($scope.model.date3.endDate).isSameOrBefore($scope.model.date1.endDate);

                };
                $scope.time = function (x, moment) {
                    return $scope.$eval("model." + x + "." + moment);
                };
                $scope.periodoActEnd = function () {
                    return $scope.periodoActual.date1.endDate;
                };
//                $scope.$watch('model.date1', function () {
//                    $scope.model.nombre = "Periodo" + ($scope.model.date1.startDate.month() + 1) + "-" + ($scope.model.date1.endDate.month() + 1) + "/" + $scope.model.date1.startDate.year();
//                }, true);

                $scope.$watch('model.date1', function () {
                    if ($scope.model.date1.startDate !== undefined)
                        $scope.model.nombre = "Periodo" + ($scope.model.date1.startDate.month() + 1) + "-" + ($scope.model.date1.endDate.month() + 1) + "/" + $scope.model.date1.startDate.year();
                }, true);

                $scope.confirmar = function (id) {
                    modalService.modalYesNo("Confirmacion", "<p>" + "¿Esta seguro de realizar la accion?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.eliminar({id: id});
                            });
                };
                $scope.eliminar = function (obj) {
                    apiConnector.post('api/periodos/del', obj).then(function (res) {
                        if (res.status === "success") {
                            $scope.cargar();
                        }
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                    });
                };
            }]).factory("factoryPeriodo", function (apiConnector) {
            var periodos = {};

            periodos.comprobarPeriodo = function () {
                return apiConnector.get('api/periodos/getPeriodoActual');
            };
            
            return periodos;
        });