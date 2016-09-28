<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIED | Registro</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="plugins/select2/select2.min.css">
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>


    </head>
    <body class="hold-transition register-page" ng-app="registro" ng-controller="controlregistro">
        <div class="register-box">

            <div class="register-box-body">
                <p class="login-box-msg"><b>Registro</b></p>
                <form>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" ng-model="nombre">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Primer Apellido" name="apellido1" ng-model="apellido1">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Segundo Apellido" name="apellido2" ng-model="apellido2">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Cedula" name="cedula" ng-model="cedula">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="correo" ng-model="correo">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Contraseña" name="contrasena" ng-model="contrasena">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Confirmar contraseña">
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <select class="form-control select2" style="width: 100%">
                            <option selected="selected" disabled="disabled">Empresa</option>
                            <option>Central de Radio</option>
                            <option>Repretel</option>
                            <option>Qualy tv</option>
                            <option>Nova</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control select2"  style="width: 100%">
                            <option selected="selected" disabled="disabled">Departamento</option>
                            <option>Deportes</option>
                            <option>Noticias</option>
                            <option>Recursos Humanos</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="login.php" class="text-center">¿Ya te has registrado?</a>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <button type="" class="btn btn-primary btn-block btn-flat" ng-click="agregarUsuario()">Registrarse</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.register-box -->
        <!-- Angular -->
        <script src="angular/angular.min.js" type="text/javascript"></script>
        <script src="controller/controlregistro.js" type="text/javascript"></script>
        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- Select2 -->
        <script src="plugins/select2/select2.full.min.js"></script>
        <script>
            //Initialize Select2 Elements
            $(".select2").select2();
        </script>
    </body>
</html>
