<!-- Content Header (Page header) -->
<section class="content-header">
 
    <h1>Administracion de Usuarios
        <small>Blank example to the fixed layout</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_usuarios">Usuarios</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="controlUsuario" ng-init="init()">
    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Administración de Usuarios</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Estado</th>
                        <th>Departamento</th>
                        <th>Empresa</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="user in users">
                        <td> {{user.nombre}} </td>
                        <td> Colaborador</td>
                        <td> Activo</td>
                        <td> {{user.departamento}}</td>
                        <td> {{user.empresa}}</td>
                        <td> <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalEdit">Editar</button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Estado</th>
                        <th>Departamento</th>
                        <th>Empresa</th>
                        <th>Detalles</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalAdd">Agregar Usuario</button>
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->


<!-- /modal -->
<div class="modal" id="modalAdd">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar un Usuario</h4>
            </div>
            <div class="modal-body">
                <form action="#/admin_metas" method="post" class="form-horizontal">
                    <div class="form-group" ng-class="{ 'has-error' : form.nombre.$invalid && !form.nombre.$pristine }">
                        <label for="nombre" class="col-sm-4 control-label">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Nombre" name="nombre" ng-model="user.nombre" required> 
                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : form.apellido1.$invalid && !form.apellido1.$pristine }">
                        <label for="apellido1" class="col-sm-4 control-label">Primer Apellido</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Primer Apellido" name="apellido1" ng-model="user.apellido1" required>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : form.apellido2.$invalid && !form.apellido2.$pristine }">
                        <label for="apellido2" class="col-sm-4 control-label">Segundo Apellido</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Segundo Apellido" name="apellido2" ng-model="user.apellido2" required>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : form.cedula.$invalid && !form.cedula.$pristine }">
                        <label for="cedula" class="col-sm-4 control-label">Cedula</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Cédula" name="cedula" ng-model="user.cedula" required>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : form.correo.$invalid && !form.correo.$pristine }">
                        <label for="correo" class="col-sm-4 control-label">Correo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Correo" name="correo" ng-model="user.correo" required>
                        </div>
                    </div>
                    <div  name="empresa" class="form-group" ng-controller="controlEmpresa" ng-init="cargarSimple()" ng-class="{ 'has-error' : form.empresa.$invalid && !form.empresa.$pristine }">
                        <label for="empresa" class="col-sm-4 control-label">Empresa</label>
                        <div class="col-sm-8">
                            <select ng-change="update()" ng-model="empresa" class="form-control select2"  
                                    ng-options="option.nombre for option in empresas track by option.id"
                                    style="width: 100%" required>
                                <option value="" disabled="disabled">Empresa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" ng-controller="controlDepartamento" ng-init="init()" ng-class="{ 'has-error' : form.departamento.$invalid && form.departamento.$dirty }">
                        <label for="empresa" class="col-sm-4 control-label">Departamento</label>
                        <div class="col-sm-8">
                            <select name="departamento" class="form-control select2"  ng-change="update()" 
                                    ng-options="option.nombre for option in departamentosfiltrados track by option.id"
                                    ng-model="departamento" style="width: 100%" required >
                                <option value="" disabled="disabled">Departamento</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="perfil" class="col-sm-4 control-label">Perfil</label>
                        <div class="col-sm-8">
                            <select class="form-control select2"  multiple="multiple"style="width: 100%" id="perfil" ng-model="user.perfil" style="width: 100%" required>
                                <option>Colaborador</option>
                                <option>Jefe</option>
                                <option>Recursos Humanos</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="estado" class="col-sm-4 control-label">Estado</label>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-block btn-success margin">Activar?</button>
                           </div> 
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-block btn-danger margin">Desactivar?</button>
                        </div> 
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<!-- /modal -->
<div class="modal" id="modalEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar un Usuario</h4>
            </div>
            <div class="modal-body">
                <form action="#/admin_metas" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Nombre" id="nombre"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="apellido1" class="col-sm-2 control-label">Primer Apellido</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Primer Apellido" id="apellido1"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="apellido2" class="col-sm-2 control-label">Segundo Apellido</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Segundo Apellido" id="apellido2"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cedula" class="col-sm-2 control-label">Cedula</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Cedula" id="cedula"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="correo" class="col-sm-2 control-label">Correo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Correo" id="correo"> 
                        </div>
                    </div>
                    <div  name="empresa" class="form-group" ng-controller="controlEmpresa" ng-init="cargarSimple()" ng-class="{ 'has-error' : form.empresa.$invalid && !form.empresa.$pristine }">
                        <label for="correo" class="col-sm-2 control-label">Empresa</label>
                        <div class="col-sm-10">
                            <select ng-change="update()" ng-model="empresa" class="form-control select2"  
                                    ng-options="option.nombre for option in empresas track by option.id"
                                    style="width: 100%" required>
                                <option value="" disabled="disabled">Empresa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" ng-controller="controlDepartamento" ng-init="init()" ng-class="{ 'has-error' : form.departamento.$invalid && form.departamento.$dirty }">
                        <select name="departamento" class="form-control select2"  ng-change="update()" 
                                ng-options="option.nombre for option in departamentosfiltrados track by option.id"
                                ng-model="departamento" style="width: 100%" required >
                            <option value="" disabled="disabled">Departamento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="perfil" class="col-sm-2 control-label">Perfil</label>
                        <div class="col-sm-10">
                            <select class="form-control" multiple="multiple" style="width: 100%" id="perfil">
                                <option selected="selected" disabled="disabled">Ninguno</option>
                                <option>Colaborador</option>
                                <option>Jefe</option>
                                <option>Recursos Humanos</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="estado" class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-10">
                            <select class="form-control select2"  style="width: 100%" id="estado">
                                <option selected="selected">Activo</option>
                                <option>Inactivo</option>
                            </select>
                        </div> 
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<script>
    //Initialize Select2 Elements
    $("#example1").DataTable();
    $(".select2").select2();
</script>  