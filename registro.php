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
        <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Select2 -->
        <link href="plugins/select/select.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <!-- tabla-->
        <link href="plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/angular-datatables.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/datatables.bootstrap.min.css" rel="stylesheet" type="text/css"/>

    </head>
    <body class="hold-transition register-page" ng-app="registro" >

        <div class="register-box" ng-controller="controlRegistro" ng-init="init()">

            <div class="register-box-body" >
                <p class="login-box-msg"><b>Registro</b></p>
                <form name="form" ng-submit="agregarUsuario()" class="form-horizontal" novalidate form-autofill-fix>
                    <div class="form-group has-feedback" ng-class="{ 'has-error' : form.nombre.$invalid && !form.nombre.$pristine }">
                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" ng-model="user.nombre" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" ng-class="{ 'has-error' : form.apellido1.$invalid && !form.apellido1.$pristine }">
                        <input type="text" class="form-control" placeholder="Primer Apellido" name="apellido1" ng-model="user.apellido1" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" ng-class="{ 'has-error' : form.apellido2.$invalid && !form.apellido2.$pristine }">
                        <input type="text" class="form-control" placeholder="Segundo Apellido" name="apellido2" ng-model="user.apellido2" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" ng-class="{ 'has-error' : form.cedula.$invalid && !form.cedula.$pristine }">
                        <input type="text" class="form-control" placeholder="Cédula" name="cedula" ng-model="user.id" required>
                        <span class="glyphicon glyphicon-qrcode form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" ng-class="{ 'has-error' : form.correo.$invalid && !form.correo.$pristine }">
                        <input type="text" class="form-control" placeholder="Correo" name="correo" ng-model="user.correo" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" ng-class="{ 'has-error' : form.contrasena.$invalid && !form.contrasena.$pristine }">
                        <input type="password" class="form-control" placeholder="Contraseña" name="contrasena" ng-model="user.contrasena" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" ng-class="{ 'has-error' : form.contrasena2.$invalid && !form.contrasena2.$pristine && !confirmarContrasena() }">
                        <input type="password" class="form-control" placeholder="Confirmar contraseña" name="contrasena2" ng-model="user.contrasena2" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group" ng-show='isCapsLockOn'>
                        <span class="fa fa-warning text-yellow" ></span><small> Bloq Mayús activado.</small>
                    </div>

                    <div  name="empresa" class="form-group has-feedback"  ng-class="{ 'has-error' : formAdd.empresa.$invalid && !formAdd.empresa.$pristine }">
                            <ui-select theme="bootstrap" ng-model="user.empresa" on-select="selectEmpresa($item)" class="form-control" title="Empresa" required>
                                <ui-select-match placeholder="">{{user.empresa.nombre}}</ui-select-match>
                                <ui-select-choices repeat="empresa in empresas | filter: $select.search" >
                                    <div ng-bind-html="empresa.nombre | highlight: $select.search"></div>
                                </ui-select-choices>
                            </ui-select> 
                        <i class="fa fa-industry form-control-feedback "></i>
                    </div>
                    <div class="form-group has-feedback"  ng-class="{ 'has-error' : formAdd.departamento.$invalid && formAdd.departamento.$dirty }">
                        
                        
                            <ui-select theme="bootstrap"  ng-model="user.departamento" on-select="" class="form-control select2" title="Departamento" required>
                                <ui-select-match placeholder="">{{user.departamento.nombre}}</ui-select-match>
                                <ui-select-choices allow-clear ="true" repeat="departamento in departamentos | filter: $select.search | filter: filtro">
                                    <div ng-bind-html="departamento.nombre | highlight: $select.search"></div>
                                </ui-select-choices>
                            </ui-select>
                        <i class="fa fa-building-o form-control-feedback "></i>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="login.php" class="text-center">¿Ya te has registrado?</a>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <button type="submit" ng-disabled="form.$invalid || !confirmarContrasena() && !validar()" class="btn btn-primary btn-block btn-flat">Registrarse</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.register-box -->

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

        <!-- Angular -->


        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- Angular-->
        <script src="angular/angular.min.js" type="text/javascript"></script>
        <script src="angular/angular-route.min.js" type="text/javascript"></script>
        <script src="angular/angular-sanitize.min.js" type="text/javascript"></script>
        <script src="angular/app.js" type="text/javascript"></script>
        <script src="bootstrap/js/ui-bootstrap-tpls-2.1.4.min.js" type="text/javascript"></script>
        <script src="angular/apiconnector.js" type="text/javascript"></script>
        <script src="angular/registro/controlRegistro.js" type="text/javascript"></script>
        <script src="angular/modal/modalService.js" type="text/javascript"></script>
        <script src="angular/usuario/userService.js" type="text/javascript"></script>
        <script src="angular/ngStorage.min.js" type="text/javascript"></script>
        <script src="angular/empresas/EmpresaService.js" type="text/javascript"></script>
        <script src="angular/ng-caps-lock.min.js" type="text/javascript"></script>
        <!-- Select2 -->
        <script src="plugins/select/select.min.js" type="text/javascript"></script>
        <script src="plugins/select2/select2.min.js" type="text/javascript"></script>
    </body>
</html>
