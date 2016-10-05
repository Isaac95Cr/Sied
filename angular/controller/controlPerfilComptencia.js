angular.module("index")
        .controller("controlPerfilCompetencia", ['$scope', 'factoryperfilCompetencia', 'modalService', function ($scope, factoryperfilCompetencia, modalService) {

                $scope.perfiles = [];
                $scope.perfil = 0;
                $scope.perfilNombre = "";

                $scope.selectPerfil = function (perfil) {
                    $scope.perfil = perfil;
                };

                $scope.init = function () {
                    $scope.cargar();
                };

                $scope.cargar = function () {
                    factoryperfilCompetencia.cargarPerfilesCompetencia()
                            .success(function (data, status, headers, config) {
                                $scope.perfiles = data.perfiles;
                                $scope.perfil = data.perfiles[0];
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

                    factoryperfilCompetencia.eliminarPerfilCompetencia(id)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>")
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
                $scope.agregar = function () {
                    var nombre = $scope.perfilNombre;
                    factoryperfilCompetencia.agregarPerfilCompetencia(nombre)
                            .success(function (data, status, headers, config) {
                                modalService.modalOk(data.titulo, "<p>" + data.msj + "</p>");
                                $scope.perfilNombre = "";
                                $scope.cargar();
                            })
                            .error(function (data, status, headers, config) {
                                alert("failure message: " + JSON.stringify(data));
                            });
                };
            }])
        .factory("factoryperfilCompetencia", function ($http) {
            var empresa = {};

            empresa.cargarPerfilesCompetencia = function () {
                return $http.get('/Sied/services/get-perfilCompetencia.php');
            };
            
            empresa.cargarPerfilCompetencia = function (id) {
                var obj = {
                    id:id
                };
                return $http.post('/Sied/services/get-perfilCompetencia.php');
            };

            empresa.agregarPerfilCompetencia = function (nombre) {
                var obj = {
                    nombre: nombre
                };
                return $http.post('/Sied/services/add-perfilCompetencia.php', obj);
            };

            empresa.eliminarPerfilCompetencia = function (id) {
                var obj = {
                    id: id
                };
                return $http.post('/Sied/services/del-perfilCompetencia.php', obj);
            };
            return empresa;
        })