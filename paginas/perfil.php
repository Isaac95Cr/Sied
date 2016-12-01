<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>Perfil
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/perfil">Perfil</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="controlPerfil" ng-init="init()">
    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="nombre" class="col-sm-3 control-label">Nombre</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" ng-model="user.nombre" required disabled> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="apellido1" class="col-sm-3 control-label">Primer Apellido</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Primer Apellido" name="apellido1" ng-model="user.apellido1" required disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="apellido2" class="col-sm-3 control-label">Segundo Apellido</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Segundo Apellido" name="apellido2" ng-model="user.apellido2" required disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cedula" class="col-sm-3 control-label">Cédula</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Cédula" name="cedula" ng-model="user.id" required disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="correo" class="col-sm-3 control-label">Correo</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Correo" name="correo" ng-model="user.correo" required disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="empresa" class="col-sm-3 control-label">Empresa</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="empresa" name="empresa" ng-model="user.empresa" required disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="departamento" class="col-sm-3 control-label">Departamento</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="departamento" name="departamento" ng-model="user.departamento" required disabled>
                    </div>
                </div>



                <div class="form-group" >
                    <label for="perfil" class="col-sm-3 control-label">Perfil</label>
                    <div class="col-sm-6">
                        <ui-select  multiple  class="form-control select2" ng-model="user.perfil" close-on-select="false" style="width: 100%;" title="Perfiles" disabled>
                            <ui-select-match placeholder="Seleccione los perfiles">{{$item}}</ui-select-match>
                            <ui-select-choices repeat="a in opciones  |  filter: $select.search" ui-disable-choice>
                                {{a}}
                            </ui-select-choices>
                        </ui-select>
                    </div> 
                </div>
            </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="button" class="btn btn-primary pull-right" href="" >Cambiar Contraseña</button>
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->