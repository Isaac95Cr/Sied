angular.module('index')
        .controller('controlCambiarPassword', ['$scope', 'modalService', 'factoryContrasena',
            'servicioCompetColab', 'autentificacionService',
            function ($scope, modalService, factoryContrasena, servicioCompetColab, autentificacionService) {

                $scope.oldPass = undefined;
                $scope.newPass = undefined;
                $scope.confirmNewPass = undefined;
                $scope.passIncorrecto = false;  // determina si se muestra el mensaje de que la contraseña actual es incorrecta.
                $scope.sonDiferentes = false;  // determina si se muestra el mensaje de que la nueva contraseña y 
                // su confirmación no son iguales.
                $scope.userOnline = undefined;
                $scope.samePasswordBD = undefined;   // con él se sabe si el pass digitado corresponde con el de la BD.
                $scope.sonIguales = undefined;   // determina si el nuevo pass y su confirmación son iguales.

                $scope.init = function () {
                    $scope.getUserOnline();
                };


                $scope.getUserOnline = function () {
                    servicioCompetColab.loadUsuarioId();
                    $scope.userOnline = servicioCompetColab.getUsuarioID();
                };


                // para cerrar la sesión actual.
                $scope.logoutCambioPassword = function () {
                    autentificacionService.logoutAndSetPassword({id: $scope.userOnline, contrasena: $scope.newPass});
                };



                $scope.confirmarSavePassword = function () {
                    modalService.modalYesNo("Confirmación", "<p>" + "¿Está seguro de cambiar la contraseña?" + "</p>")
                            .result.then(function (selectedItem) {
                                if (selectedItem === "si") {
                                    modalService.modalOk("Aviso", "<p>¡Debe iniciar sesión de nuevo!</p>")
                                            .result.then(function () {
                                                $scope.logoutCambioPassword();
                                            });
                                }

                            });
                };


                // función para comprobar si el password actual coincide con el de la BD.
                $scope.comprobarPasswordViejo = function () {
                    var obj = {id: $scope.userOnline, contrasena: $scope.oldPass};

                    return factoryContrasena.comprobarOldPassword(obj)
                            .then(function (res) {
                                if (res.status === 'error') {
                                    alert(res.message);
                                }
                                if (res.status === 'success') {
                                    $scope.samePasswordBD = res.data;
                                }
                            });
                };


                $scope.saveChanges = function () {
                    $scope.passIncorrecto = false;  // determina si se muestra el mensaje de que la contraseña actual es incorrecta.
                    $scope.sonDiferentes = false;

                    $scope.comprobarPasswordViejo().then(function () {
                        $scope.sonIguales = angular.equals($scope.newPass, $scope.confirmNewPass); // comparar el password nuevo y su confirmación...

                        if ($scope.samePasswordBD && $scope.sonIguales) {  // si son iguales actualice...

                            $scope.confirmarSavePassword();

                        } else if (!$scope.samePasswordBD) {  // sino, que indique que el pass actual es incorrecto

                            $scope.passIncorrecto = true;

                        } else {  // sino, entonces que muestre el mensaje que diga que no son iguales la nueva y la confirmación...
                            $scope.sonDiferentes = true;
                        }
                    });

                };


            }]).factory("factoryContrasena", function (apiConnector) {
    var password = {};

    password.comprobarOldPassword = function (obj) {
        return apiConnector.post('api/usuarios/comprobarPassword', obj);
    };

    return password;

});



