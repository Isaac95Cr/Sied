angular.module("index")
        .controller("controlMeta",['$scope', 'factoryMeta','ShareDataService','modalService',  function ($scope, factoryMeta, ShareDataService, modalService) {

            $scope.metas = [];
            $scope.meta = 0;
            
            $scope.meta_isEvaluable = 1;
            $scope.meta_peso = 0;
            $scope.meta_titulo = "";
            $scope.meta_descripcion = "";

            $scope.selectMeta = function (msg) {
                ShareDataService.prepForBroadcast(msg);
            };

            $scope.init = function () {
                $scope.cargar();
            };
            

            $scope.cargar = function () {
                /*factoryMeta.cargarMetas()
                        .success(function (data, status, headers, config) {
                            $scope.metas = data.meta;
                            $scope.selectMeta(data.meta[0]);
                        })
                        .error(function (data, status, headers, config) {
                            alert("failure message: " + JSON.stringify(headers));
                        });*/
            };

            $('input').on('ifUnchecked', function() {
                       $scope.meta_isEvaluable = 0;
             });
            
            $('input').on('ifChecked', function() {
                       $scope.meta_isEvaluable = 1;
             });
             

            
            
            $scope.eliminar = function (id) {
                /*factoryMeta.eliminarMeta(id)
                        .success(function (data, status, headers, config) {
                            modalService.modalOk(data.titulo,"<p>"+data.msj+"</p>");
                            $scope.cargar();
                        })
                        .error(function (data, status, headers, config) {
                            alert("failure message: " + JSON.stringify(data));
                        });*/
            };
            
            
            $scope.agregar = function () {
               var metaObj = {
                    is_Evaluable: $scope.meta_isEvaluable,
                    peso: $scope.meta_peso,
                    titulo: $scope.meta_titulo,
                    descripcion: $scope.meta_descripcion
                };
                
                factoryMeta.agregarMeta(metaObj)
                        .success(function (data, status, headers, config) {
                            modalService.modalOk(data.titulo,"<p>"+data.msj+"</p>");
                            $scope.meta_isEvaluable = 1;
                            $scope.meta_peso = 0;
                            $scope.meta_titulo = "";
                            $scope.meta_descripcion = "";
                            $scope.cargar();
                        })
                        .error(function (data, status, headers, config) {
                            alert("failure message: " + JSON.stringify(data));
                        });
            };
        }])
        .factory("factoryMeta", function ($http) {
            var meta = {};

            meta.cargarMetas = function () {
                //return $http.get('/Sied/services/get-empresa.php');
            };

            meta.agregarMeta = function (metaObj) {
                return $http.post('/Sied/services/add-meta.php', metaObj);
            };

            meta.eliminarMeta = function (id) {
                var objMeta = {
                };
                //return $http.post('/Sied/services/del-empresa.php', obj);
            };
            return meta;
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
        });





