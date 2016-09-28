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
<section class="content">
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
                    <tr>
                        <td> Juan </td>
                        <td> Colaborador</td>
                        <td> Activo</td>
                        <td> TI</td>
                        <td> Repretel</td>
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
                    <div class="form-group">
                        <label for="empresa" class="col-sm-2 control-label">Empresa</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%" id="empresa">
                                <option selected="selected" disabled="disabled">Empresa</option>
                                <option>Central de Radio</option>
                                <option>Repretel</option>
                                <option>Qualy tv</option>
                                <option>Nova</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="departamento" class="col-sm-2 control-label">Departamento</label>
                        <div class="col-sm-10">
                            <select class="form-control select2"  style="width: 100%" id="departamento">
                                <option selected="selected" disabled="disabled">Departamento</option>
                                <option>Deportes</option>
                                <option>Noticias</option>
                                <option>Recursos Humanos</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="perfil" class="col-sm-2 control-label">Perfil</label>
                        <div class="col-sm-10">
                            <select class="form-control select2"  style="width: 100%" id="perfil">
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
                                <option selected="selected" disabled="disabled">Activo</option>
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
                    <div class="form-group">
                        <label for="empresa" class="col-sm-2 control-label">Empresa</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%" id="empresa">
                                <option selected="selected" disabled="disabled">Empresa</option>
                                <option>Central de Radio</option>
                                <option>Repretel</option>
                                <option>Qualy tv</option>
                                <option>Nova</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="departamento" class="col-sm-2 control-label">Departamento</label>
                        <div class="col-sm-10">
                            <select class="form-control select2"  style="width: 100%" id="departamento">
                                <option selected="selected" disabled="disabled">Departamento</option>
                                <option>Deportes</option>
                                <option>Noticias</option>
                                <option>Recursos Humanos</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="perfil" class="col-sm-2 control-label">Perfil</label>
                        <div class="col-sm-10">
                            <select class="form-control select2"  style="width: 100%" id="perfil">
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