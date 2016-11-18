angular.module('empdep')
        .service('empresaService', ['factoryEmpresa', function (factoryEmpresa) {
                var service = {
                    empresas: undefined,
                    empresa: undefined,
                    empresaAnt: undefined
                };

                this.cargar = function () {
                    return factoryEmpresa.cargarEmpresas()
                            .success(function (data, status, headers, config) {
                                service.empresas = data.empresa;

                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };
                this.eliminar = function (obj) { // id
                    return factoryEmpresa.eliminarEmpresa(obj);
                };
                this.modificar = function (obj) {
                    return factoryEmpresa.modificarEmpresa(obj);
                };
                this.agregar = function (obj) { //nombre
                    return factoryEmpresa.agregarEmpresa(obj);
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
        .service('departamentoService', ['factoryDepartamento', function (factoryDepartamento) {
                var service = {
                    departamentos: undefined,
                    departamento: undefined,
                    departamentoAnt: undefined
                };

                this.cargar = function () {
                    return factoryDepartamento.cargarDepartamentos()
                            .success(function (data, status, headers, config) {
                                service.departamentos = data.departamento;
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(headers));
                            });
                };
                this.eliminar = function (obj) { // id
                    return factoryDepartamento.eliminarDepartamento(obj);
                };
                this.modificar = function (obj) {
                    return factoryDepartamento.modificarDepartamento(obj);
                };
                this.agregar = function (obj) { //nombre //empresa
                    return factoryDepartamento.agregarDepartamento(obj);
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