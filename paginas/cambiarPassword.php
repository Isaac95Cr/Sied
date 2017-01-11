<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>Cambiar Contraseña
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/perfil">Perfil</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="controlCambiarPassword" ng-init="init()">
    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Cambiar la contraseña</h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        <div class="box-body">
            <form name="formCambiarPass" ng-submit="saveChanges()" class="form-horizontal" novalidate>

                <div class="form-group" ng-class="{ 'has-error' : formCambiarPass.passwordActual.$invalid && !formCambiarPass.passwordActual.$pristine}">
                    <label for="passwordActual" class="col-sm-3 control-label">Digite la contraseña actual:</label>
                    <label ng-show="passIncorrecto" style="color: #dd4b39; font-weight: bolder; font-size: x-large">*</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" placeholder="Contraseña actual" ng-model="oldPass" name="passwordActual" required>
                        <p ng-show="formCambiarPass.passwordActual.$invalid && !formCambiarPass.passwordActual.$pristine" class="help-block">Contraseña actual requerida.</p>
                    </div>
                </div>

                <div class="form-group" ng-class="{ 'has-error' : formCambiarPass.passwordNuevo.$invalid && !formCambiarPass.passwordNuevo.$pristine}">
                    <label for="passwordNuevo" class="col-sm-3 control-label">Digite la nueva contraseña:</label>
                    <label ng-show="sonDiferentes" style="color: #dd4b39; font-weight: bolder; font-size: x-large">*</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" placeholder="Nueva contraseña" ng-model="newPass" name="passwordNuevo" required>
                        <p ng-show="formCambiarPass.passwordNuevo.$invalid && !formCambiarPass.passwordNuevo.$pristine" class="help-block">Contraseña nueva requerida.</p>
                    </div>
                </div>

                <div class="form-group" ng-class="{ 'has-error' : formCambiarPass.passwordConfirma.$invalid && !formCambiarPass.passwordConfirma.$pristine}">
                    <label for="passwordConfirma" class="col-sm-3 control-label">Confirme la nueva contraseña:</label>
                    <label ng-show="sonDiferentes" style="color: #dd4b39; font-weight: bolder; font-size: x-large">*</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" placeholder="Nueva contraseña" ng-model="confirmNewPass" name="passwordConfirma" required>
                        <p ng-show="formCambiarPass.passwordConfirma.$invalid && !formCambiarPass.passwordConfirma.$pristine" class="help-block">Confirmación de contraseña requerida.</p>
                    </div>
                </div>

                <div class="form-group" ng-show='isCapsLockOn'>
                    <div class="col-sm-4">
                        <span class="fa fa-warning text-yellow" ></span><small> Bloq Mayús activado.</small>
                    </div>
                </div>

                <p ng-show="passIncorrecto" style="color: #dd4b39; ">(*) La contraseña actual no es correcta.</p>
                <p ng-show="sonDiferentes" style="color: #dd4b39; ">(*) La nueva contraseña y su confimación no coinciden.</p>


                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right" ng-disabled="formCambiarPass.$invalid" href="" >Guardar Cambios</button>
                </div>
            </form>

        </div>
        <!-- /.box-body -->

        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->