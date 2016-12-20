angular.module('empdep')
        .service('empresaService', ['apiConnector', function (apiConnector) {
                var service = {
                    empresas: undefined,
                    empresa: undefined,
                    empresaAnt: undefined
                };

                this.cargar = function () {
                    return apiConnector.get("api/empresas/all").then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            service.empresas = res.data;
                        }
                    });
                };
                this.eliminar = function (obj) {
                   return apiConnector.post("api/empresas/del",obj);
                };
                this.modificar = function (obj) {
                    return apiConnector.put("api/empresas/set",obj);
                };
                this.agregar = function (obj) {
                    return apiConnector.post('api/empresas/add',obj);
                };

                this.getEmpresas = function () {
                    return service.empresas;
                };

                this.setEmpresa = function (empresa) {
                    service.empresa = empresa;
                };

                this.getEmpresa = function () {
                    return service.empresa;
                };

                this.buscarEmpresa = function (nombre) {
                    return service.empresas.find(function (empresa) {
                        return empresa.nombre === nombre;
                    });
                };
            }])
        .service('departamentoService', ['apiConnector', function (apiConnector) {
                var service = {
                    departamentos: undefined,
                    departamento: undefined,
                    departamentoAnt: undefined
                };

                this.cargar = function () {
                    return apiConnector.get("api/departamentos/all").then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            service.departamentos = res.data;
                        }
                    });
                };
                
                 // llama al método que carga departamentos y los usuarios de cada uno.
                this.cargarConUsuarios = function () {
                    return apiConnector.get("api/departamentos/allAndUsers").then(function (res) {
                        if (res.status === 'error') {
                            alert(res.message);
                        }
                        if (res.status === 'success') {
                            service.departamentos = res.data;
                        }
                    });
                };
                
                this.eliminar = function (obj) {
                   return apiConnector.post("api/departamentos/del",obj);
                };
                this.modificar = function (obj) {
                    return apiConnector.put("api/departamentos/set",obj);
                };
                this.agregar = function (obj) {
                    return apiConnector.post('api/departamentos/add',obj);
                };

                this.getDepartamentos = function () {
                    return service.departamentos;
                };

                this.setDepartamento = function (departamento) {
                    service.departamento = departamento;
                };
                this.buscarDepartamento = function (nombre) {
                    return service.departamentos.find(function (dep) {
                        return dep.nombre === nombre;
                    });
                };
            }])
        .service('empdep', ['departamentoService', 'empresaService', function (departamentoService, empresaService) {

                this.cargarEmp = function () {
                    return empresaService.cargar();
                };
                this.cargarDep = function () {
                    return departamentoService.cargar();
                };
                this.getDepService = function () {
                    return departamentoService;
                };

                this.getEmpService = function () {
                    return empresaService;
                };
                this.getEmpresas = function () {
                    return empresaService.getEmpresas();
                };

                this.setEmpresa = function (empresa) {
                    empresaService.setEmpresa(empresa);
                };

                this.getEmpresa = function () {
                    return empresaService.getEmpresa();
                };

                this.getDepartamentos = function () {
                    return departamentoService.getDepartamentos();
                };

                this.setDepartamento = function (departamento) {
                    departamentoService.setDepartamento(departamento);
                };

                this.getDepartamento = function () {
                    return departamentoService.getDepartamento();
                };
                this.buscarEmpresa = function (nombre) {
                    return empresaService.buscarEmpresa(nombre);
                };
                this.buscarDepartamento = function (nombre) {
                    return departamentoService.buscarDepartamento(nombre);
                };
            }])
        .factory("factoryDepartamento", function ($http) {
            var departamentos = {};

            departamentos.cargarDepartamentos = function () {
                return $http.get('/Sied/services/departamento/get-departamento.php');
            };
            departamentos.agregarDepartamento = function (obj) {
                return $http.post('/Sied/services/departamento/add-departamento.php', obj);
            };
            departamentos.modificarDepartamento = function (obj) {
                return $http.post('/Sied/services/departamento/set-departamento.php', obj);
            };
            departamentos.eliminarDepartamento = function (obj) {
                return $http.post('/Sied/services/departamento/del-departamento.php', obj);
            };

            return departamentos;
        })
