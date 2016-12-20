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
        <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <!-- tabla-->
        <link href="plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/angular-datatables.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/datatables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="hold-transition login-page" ng-app="registro" ng-controller="controlLogin">
        <div class="login-box">
            <div class="login-logo">
                <h4><b>Sistema de Evaluación del Desempeño</b></h4>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg"><b>¿Olvidó su contraseña?</b></p>
                <form name="form" class="form-horizontal" ng-submit="correoContrasena()" method="post" novalidate>
                    <p> Puedes restablecer tu contraseña ingresando tu cédula y siguiendo los pasos que llegaran a su correo electronico.</p>
                    <br>
                    <div class="form-group" ng-class="{ 'has-error' : form.id.$invalid && !form.id.$pristine}">
                        <label for="id" class="col-sm-3 control-label">Cédula</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Digite su cédula" name="id" ng-model="user.id" required>
                            <p ng-show="form.id.$invalid && !form.id.$pristine" class="help-block">Identificación requerida.</p>
                        </div>
                    </div>
                    <div class="form-group" ng-show='isCapsLockOn'>
                        <span class="fa fa-warning text-yellow" ></span><small> Bloq Mayús activado.</small>
                    </div>
                    <div class="row">
                        <div class="col-xs-6"><br>
                            <a href="login.php"> Ir a Login</a><br>
                            <a href="registro.php" class="text-center">Ir a Registrarse</a>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6" style="text-align: center"><br>
                            <button type="submit" ng-if="bandera" ng-disabled="form.$invalid" class="btn btn-primary btn-block btn-flat">Restablecer</button>
                            <p ng-if="!bandera"> Revise su correo electrónico </p>
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
        <script src="angular/angular-sanitize.min.js" type="text/javascript"></script>
        <script src="angular/ngStorage.min.js" type="text/javascript"></script>
        <script src="angular/app.js" type="text/javascript"></script>
        <script src="bootstrap/js/ui-bootstrap-tpls-2.1.4.min.js" type="text/javascript"></script>
        <script src="angular/apiconnector.js" type="text/javascript"></script>
        <script src="angular/registro/controlLogin.js" type="text/javascript"></script>
        <script src="angular/modal/modalService.js" type="text/javascript"></script>
        <script src="angular/usuario/autentificacionService.js" type="text/javascript"></script>
        <script src="angular/usuario/sessionService.js" type="text/javascript"></script>
        <script src="angular/ngStorage.min.js" type="text/javascript"></script>
        <script src="angular/empresas/EmpresaService.js" type="text/javascript"></script>
        <script src="angular/ng-caps-lock.min.js" type="text/javascript"></script>
        <!-- Select2 -->
        <script src="plugins/select/select.min.js" type="text/javascript"></script>
        <script src="plugins/select2/select2.min.js" type="text/javascript"></script>

    </body>
</html>

