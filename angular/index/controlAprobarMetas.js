angular.module("index")
        .controller("controlAprobarMetas", ['$scope', 'factoryMeta', '$routeParams', 'modalService', function ($scope, factoryMeta, $routeParams, modalService) {
                
        $scope.metasUser = [];
        $scope.tiene_Metas = false;

        $scope.init = function () {
                    $scope.cargar();
         };


        $scope.cargar = function () {
            var obj = {id:$routeParams.id}
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
          
          
          
                        
}])
.directive('iCheck', ['$timeout', '$parse', function ($timeout, $parse) {
                return {
                    require: 'ngModel',
                    link: function ($scope, element, $attrs, ngModel) {
                        return $timeout(function () {
                            var value = $attrs.value;
                            var $element = $(element);

                            // Instantiate the iCheck control.                            
                            $element.iCheck({
                                checkboxClass: 'icheckbox_flat-blue',
                            });

                            // If the model changes, update the iCheck control.
                            $scope.$watch($attrs.ngModel, function (newValue) {
                                $element.iCheck('update');
                            });

                            // If the iCheck control changes, update the model.
                            $element.on('ifChanged', function (event) {
                                if ($element.attr('type') === 'checkbox' && $attrs.ngModel) {
                                    $scope.$apply(function () {
                                        ngModel.$setViewValue(value);
                                    });
                                }
                            });

                        });
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
//                    checkboxClass: 'icheckbox_square-blue',
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