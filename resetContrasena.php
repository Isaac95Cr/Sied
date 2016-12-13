<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIED | Reset Contraseña</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <!-- tabla-->
        <link href="plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/angular-datatables.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/datatables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="hold-transition login-page" ng-app="registro" ng-controller="controlLogin" ng-init="initReset()">
        <div class="login-box">
            <div class="login-logo">
                <h4><b>Sistema de Evaluación del Desempeño</b></h4>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg"><b>Reset Contraseña</b></p>
                <form name="form" class="form-horizontal" ng-submit="setContrasena()" method="post" novalidate>
                    <p> Has solicitado cambiar tu contraseña para la identificación {{user.id}} , digita la nueva contraseña y confírmala para hacerla valida. </p>
                    <br>
                    <div class="form-group" ng-class="{ 'has-error' : form.contrasena.$invalid && !form.contrasena.$pristine && !confirmarContrasena()}">
                        <label for="id" class="col-sm-4 control-label">Nueva Contraseña</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="Digite su nueva contraseña" name="contrasena" ng-model="user.contrasena" required>
                            <p ng-show="form.contrasena.$invalid && !form.contrasena.$pristine" class="help-block">Contraseña requerida.</p>
                        </div>

                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : form.contrasena2.$invalid && !form.contrasena2.$pristine && !confirmarContrasena()}">
                        <label for="id" class="col-sm-4 control-label">Confirmar Contraseña</label>
                        <div class="col-sm-8 ">
                            <input type="password" class="form-control" placeholder="Confirme la contraseña" name="contrasena2" ng-model="user.contrasena2" required>
                            <p ng-show="form.contrasena2.$invalid && !form.contrasena2.$pristine" class="help-block">Confirmación requerida.</p>
                            <p ng-show="!confirmarContrasena() && !form.contrasena2.$pristine" class="help-block">La confirmación es incorrecta.</p>
                        </div>
                        
                    </div>
                    <div class="form-group" ng-show='isCapsLockOn'>
                        <span class="fa fa-warning text-yellow" ></span><small> Mayus.</small>
                    </div>
                    <div class="row" class="">
                        <div class="col-xs-12" style="text-align: center"><br>
                            <button type="submit" ng-if="bandera" ng-disabled="form.$invalid || !confirmarContrasena()" class="btn btn-primary btn-block btn-flat">Restablecer contraseña</button>
                            <a href="login.php" ng-if="!bandera"> Ir a Login</a><br>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->
        </div>
        <script type="text/ng-template" id="myModalContent.html">
            <div class="modal-header">
            <button type="button" class="close" ng-click="$close()" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">{{ vm.titulo }} </h3>
            </div>
            <form name="form" class="form-horizontal" novalidate>
            <div class="modal-body">
            <div compile-data template="{{vm.contenido}}">

            </div>
            </div>
            <div class="modal-footer">
            <div compile-data template="{{vm.footer}}">

            </div>
            </div>
            </form>

        </script> 
        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="angular/angular.min.js" type="text/javascript"></script>
        <script src="angular/angular-route.min.js" type="text/javascript"></script>
        <script src="angular/ngStorage.min.js" type="text/javascript"></script>
        <script src="angular/angular-sanitize.min.js" type="text/javascript"></script>
        <script src="angular/ng-caps-lock.min.js" type="text/javascript"></script>
        <script src="angular/app.js" type="text/javascript"></script>
        <script src="angular/apiconnector.js" type="text/javascript"></script>
        <script src="bootstrap/js/ui-bootstrap-tpls-2.1.4.min.js" type="text/javascript"></script>
        <script src="angular/registro/controlLogin.js" type="text/javascript"></script>
        <script src="angular/modal/modalService.js" type="text/javascript"></script>
        <script src="angular/usuario/autentificacionService.js" type="text/javascript"></script>
        <script src="angular/usuario/sessionService.js" type="text/javascript"></script>
        <script src="angular/ngStorage.min.js" type="text/javascript"></script>
        <script src="angular/empresas/EmpresaService.js" type="text/javascript"></script>
        <!-- Select2 -->
        <script src="plugins/select/select.min.js" type="text/javascript"></script>
        <script src="plugins/select2/select2.min.js" type="text/javascript"></script>

    </body>
</html>

