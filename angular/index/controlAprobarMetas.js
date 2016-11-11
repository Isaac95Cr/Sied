angular.module("index")
        .controller("controlAprobarMetas", ['$scope', 'factoryMeta', 'userService', '$routeParams', 'modalService', function ($scope, factoryMeta, userService, $routeParams, modalService) {
                
        $scope.metasUser = [];
        $scope.tiene_Metas = false;
        $scope.colaborador = "";

                $scope.metasUser = [];
                $scope.tiene_Metas = false;

                $scope.init = function () {
                    $scope.cargar();
                    $scope.cargarColaborador();
         };


                $scope.cargar = function () {
                    var obj = {id: $routeParams.id}
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
          
          
          
                        
}])
.directive('iCheck', ['$timeout', '$parse', function ($timeout, $parse) {
                return {
                    require: 'ngModel',
                    link: function ($scope, element, $attrs, ngModel) {
                        return $timeout(function () {
                            var value = $attrs['value'];
                            var color = $attrs['color'];
                            if(!color){
                                color = "blue";
                            }
                            $scope.$watch($attrs['ngModel'], function (newValue) {
                                $(element).iCheck('update');
                            });

                            $scope.$watch($attrs['ngDisabled'], function (newValue) {
                                $(element).iCheck(newValue ? 'disable' : 'enable');
                                $(element).iCheck('update');
                            });

                            return $(element).iCheck({
                                checkboxClass: 'icheckbox_flat-'+color,
                                radioClass: 'iradio_minimal'
                            }).on('ifToggled', function (event) {
                                if ($(element).attr('type') === 'checkbox' && $attrs['ngModel']) {
                                    $scope.$apply(function () {
                                        return ngModel.$setViewValue(event.target.checked);
                                    });
                                }
                                if ($(element).attr('type') === 'radio' && $attrs['ngModel']) {
                                    return $scope.$apply(function () {
                                        return ngModel.$setViewValue(value);
                                    });
                                }
                            });
                        }, 300);
                    }
                };
            }]);



// .directive('iCheck', function ($timeout, $parse) {
//    return {
//        require: 'ngModel',
//        link: function ($scope, element, $attrs, ngModel) {
//            return $timeout(function () {
//                var value;
//                value = $attrs['value'];
//
//                $scope.$watch($attrs['ngModel'], function (newValue) {
//                    $(element).iCheck('update');
//                });
//
//                $scope.$watch($attrs['ngDisabled'], function (newValue) {
//                    $(element).iCheck(newValue ? 'disable' : 'enable');
//                    $(element).iCheck('update');
//                })
//
//                return $(element).iCheck({
//                    checkboxClass: 'icheckbox_flat-blue',
//                    radioClass: 'iradio_square-blue'
//
//                }).on('ifChanged', function (event) {
//                    if ($(element).attr('type') === 'checkbox' && $attrs['ngModel']) {
//                        $scope.$apply(function () {
//                            return ngModel.$setViewValue(event.target.checked);
//                        })
//                    }
//                }).on('ifClicked', function (event) {
//                    if ($(element).attr('type') === 'checkbox' && $attrs['ngModel']) {
//                        return $scope.$apply(function () {
//                            //set up for radio buttons to be de-selectable
//                            if (ngModel.$viewValue !== value)
//                                return ngModel.$setViewValue(value);
//                            else
//                                ngModel.$setViewValue(null);
//                            ngModel.$render();
//                            return
//                        });
//                    }
//                });
//            });
//        }
//    };
//});
