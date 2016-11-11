angular.module("index")
        .controller("controlEmpresa", ['$scope', 'empdep', 'ShareDataService', 'modalService', function ($scope, empdep, ShareDataService, modalService) {

                $scope.empresas = [];
                $scope.empresaEdit = {
                    id: undefined,
                    nombre: undefined
                };
                $scope.prueba = function (){
                    $scope.empresas = empdep.getEmpresas();
                };
                
                $scope.init = function () {
                    $scope.cargar();
                };
                $scope.selectEmpresa = function (empresa) {
                    empdep.setEmpresa(empresa);
                    
                };
                $scope.cargar = function () {
                    empdep.cargarEmp().then(function () {
                        $scope.empresas = empdep.getEmpresas();
                    });
                };
                $scope.agregar = function () {    
                    empdep.getEmpService().agregar($scope.empresaAdd)
                            .success(function (data, status, headers, config) {
                                $scope.cargar();
                                $scope.empresaAdd = "";
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.confirmar = function (id) {
                    modalService.modalYesNo("Confirmacion", "<p>" + "¿Esta seguro de realizar la accion?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si")
                                    $scope.eliminar(id);
                            });
                };
                $scope.eliminar = function (obj) { // id
                    empdep.getEmpService().eliminar(obj)
                            .success(function (data, status, headers, config) {
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.modalModificar = function (empresa) {
                    $scope.selectEmpresa(empresa);
                    $scope.empresaEdit = empresa;
                    modalService.open("#modalEmpresaEdit");
                };
                $scope.modificar = function () {
                    empdep.getEmpService().modificar($scope.empresaEdit)
                            .success(function (data, status, headers, config) {
                                $scope.empresaEdit.id = undefined;
                                $scope.empresaEdit.nombre = undefined;
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
                return $http.get('/Sied/services/empresa/get-empresa.php');
            };

            empresa.agregarEmpresa = function (nombre) {
                var obj = {
                    nombre: nombre
                };
                return $http.post('/Sied/services/empresa/add-empresa.php', obj);
            };
            empresa.modificarEmpresa = function (obj) {
                return $http.post('/Sied/services/empresa/set-empresa.php', obj);
            };

            empresa.eliminarEmpresa = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/empresa/del-empresa.php', obj);
            };
            return empresa;
        })

        .factory('ShareDataService', function ($rootScope) {
            var sharedService = {};

            sharedService.msg = {};
            sharedService.departamento = {};
            sharedService.empresa = {};

            sharedService.setEmpresa = function (msg) {
                this.empresa = msg;
                this.broadcastEmpresa();
            };

            sharedService.setDepartamento = function (msg) {
                this.departamento = msg;
                this.broadcastDepartamento();
            };

            sharedService.broadcastDepartamento = function () {
                $rootScope.$broadcast('departamento');
            };
            sharedService.broadcastEmpresa = function () {
                $rootScope.$broadcast('empresa');
            };

            return sharedService;
        });



