<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIED | Login</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="hold-transition login-page" ng-app="registro" ng-controller="controlLogin">
        <div class="login-box">
            <div class="login-logo">
                <h4><b>Sistema de Evaluación del Desempeño</b></h4>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg"><b>Inicio de Sesion </b></p>
                <form name="form" ng-submit="login()" method="post" novalidate>
                    <div class="form-group has-feedback" ng-class="{ 'has-error' : form.id.$invalid && !form.id.$pristine }">
                        <input type="text" class="form-control" placeholder="Cédula" name="id" ng-model="user.id" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" ng-class="{ 'has-error' : form.contrasena.$invalid && !form.contrasena.$pristine }">
                        <input type="password" class="form-control" placeholder="Contraseña" name="contrasena" ng-model="user.contrasena" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#">¿Olvidó su contraseña?</a><br>
                            <a href="registro.php" class="text-center">Registrarse</a>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <button type="submit" ng-disabled="form.$invalid" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="angular/angular.min.js" type="text/javascript"></script>
        <script src="angular/angular-resource.min.js" type="text/javascript"></script>       
        <script src="angular/angular-route.min.js" type="text/javascript"></script>
        <script src="angular/ngStorage.min.js" type="text/javascript"></script>
        <script src="angular/app.js" type="text/javascript"></script>
        <script src="bootstrap/js/ui-bootstrap-tpls-2.1.4.min.js" type="text/javascript"></script>
        <script src="angular/registro/controlLogin.js" type="text/javascript"></script>
        <script src="angular/modal/modalService.js" type="text/javascript"></script>
        <script src="angular/usuario/autentificacionService.js" type="text/javascript"></script>
        <script src="angular/usuario/sessionService.js" type="text/javascript"></script>
    </body>
</html>
