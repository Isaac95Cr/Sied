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
<section class="content" ng-controller="controlUsuario as cu" ng-init="init()">
    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Administración de Usuarios</h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-hover table-bordered table-responsive" datatable="ng">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Estado</th>
                        <th>Departamento</th>
                        <th>Empresa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="user in users" sglclick="" dblclick="modalModificar({{user}});">
                        <td> {{user.nombre + " " + user.apellido1 + " " + user.apellido2}} </td>
                        <td class="text-center"> 
                            <small ng-show="user.perfil.colaborador == 1" class="label bg-blue margin">Colaborador</small>
                            <small ng-show="user.perfil.jefe == 1"class="label bg-blue margin">Jefe</small>
                            <small ng-show="user.perfil.RH == 1"class="label bg-blue margin">RH</small>
                        </td>
                        <td> 
                            <small ng-show="user.estado == 1" class="label bg-green margin">Activo</small>
                            <small ng-show="user.estado != 1"class="label bg-red margin">Inactivo</small>
                        </td>
                        <td> {{user.departamento}}</td>
                        <td> {{user.empresa}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Estado</th>
                        <th>Departamento</th>
                        <th>Empresa</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalUserAdd">Agregar Usuario</button>
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

    <!-- /modal -->
    <div class="modal" id="modalUserAdd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar un Usuario</h4>
                </div>
                 <form name="formAdd"  method="post" class="form-horizontal">
                <div class="modal-body">
                   
                        <div class="form-group" ng-class="{ 'has-error' : formAdd.nombre.$invalid && !formAdd.nombre.$pristine }">
                            <label for="nombre" class="col-sm-4 control-label">Nombre</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre" ng-model="userAdd.nombre" required> 
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error' : formAdd.apellido1.$invalid && !formAdd.apellido1.$pristine }">
                            <label for="apellido1" class="col-sm-4 control-label">Primer Apellido</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Primer Apellido" name="apellido1" ng-model="userAdd.apellido1" required>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error' : formAdd.apellido2.$invalid && !formAdd.apellido2.$pristine }">
                            <label for="apellido2" class="col-sm-4 control-label">Segundo Apellido</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Segundo Apellido" name="apellido2" ng-model="userAdd.apellido2" required>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error' : formAdd.cedula.$invalid && !formAdd.cedula.$pristine }">
                            <label for="cedula" class="col-sm-4 control-label">Cedula</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Cédula" name="cedula" ng-model="userAdd.cedula" required>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error' : formAdd.correo.$invalid && !formAdd.correo.$pristine }">
                            <label for="correo" class="col-sm-4 control-label">Correo</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Correo" name="correo" ng-model="userAdd.correo" required>
                            </div>
                        </div>
                        <div  name="empresa" class="form-group"  ng-class="{ 'has-error' : formAdd.empresa.$invalid && !formAdd.empresa.$pristine }">
                            <label for="empresa" class="col-sm-4 control-label">Empresa</label>
                            <div class="col-sm-8" ng-controller="controlEmpresa" ng-init="cargarSimple()">
                                <ui-select theme="bootstrap" ng-model="empresa" on-select="selectEmpresa($item)" class="form-control select2" title="Empresa" required>
                                    <ui-select-match placeholder="">{{$select.selected.nombre}}</ui-select-match>
                                    <ui-select-choices repeat="empresa in empresas | filter: $select.search" >
                                        <div ng-bind-html="empresa.nombre | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group"  ng-class="{ 'has-error' : formAdd.departamento.$invalid && formAdd.departamento.$dirty }">
                            <label for="departamento" class="col-sm-4 control-label">Departamento</label>                     
                            <div class="col-sm-8" ng-controller="controlDepartamento" ng-init="init()">
                                <ui-select theme="bootstrap"  ng-model="departamento.selected" on-select="update()" class="form-control select2" title="Departamento" required>
                                    <ui-select-match placeholder="">{{$select.selected.nombre}}</ui-select-match>
                                    <ui-select-choices allow-clear ="true" repeat="departamento in departamentos | filter: $select.search | filter: filtro">
                                        <div ng-bind-html="departamento.nombre | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error' : formAdd.empresa.$invalid && !formAdd.empresa.$pristine }">
                            <label for="perfil" class="col-sm-4 control-label">Perfil</label>
                            <div class="col-sm-8">
                                <ui-select  multiple  class="form-control select2" ng-model="userAdd.perfil" close-on-select="false" style="width: 100%;" title="Asigna el perfil" required>
                                    <ui-select-match placeholder="Seleccione los perfiles">{{$item}}</ui-select-match>
                                    <ui-select-choices repeat="a in opciones  |  filter: $select.search">
                                        {{a}}
                                    </ui-select-choices>
                                </ui-select>
                            </div> 
                        </div>
                        <div class="form-group">
                            <label for="estado" class="col-sm-4 control-label">Estado</label>
                            <div class="col-sm-3">
                                <input type="checkbox" id="" name="" ng-model="userAdd.estado" color="green"  i-check 
                                       ng-checked="userAdd.estado == 1" ng-true-value="'1'" ng-false-value="'0'">
                                <label for="" class="control-label">Activo</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="checkbox" id="" name="" ng-model="userAdd.estado" color="red"  i-check 
                                       ng-checked="userAdd.estado != 1" ng-true-value="'0'" ng-false-value="'1'">
                                <label for="" class="control-label">Inactivo</label>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" ng-click="agregar()" class="btn btn-primary" ng-disabled="formAdd.$invalid" closemodal="modalUserAdd">Agregar</button>
                </div>
                     </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <!-- /modal -->
    <div class="modal" id="modalUserEdit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar un Usuario</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-horizontal">
                        <div class="form-group" ng-class="{ 'has-error' : form.nombre.$invalid && !form.nombre.$pristine }">
                            <label for="nombre" class="col-sm-4 control-label">Nombre</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre" ng-model="userEdit.nombre" required> 
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error' : form.apellido1.$invalid && !form.apellido1.$pristine }">
                            <label for="apellido1" class="col-sm-4 control-label">Primer Apellido</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Primer Apellido" name="apellido1" ng-model="userEdit.apellido1" required>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error' : form.apellido2.$invalid && !form.apellido2.$pristine }">
                            <label for="apellido2" class="col-sm-4 control-label">Segundo Apellido</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Segundo Apellido" name="apellido2" ng-model="userEdit.apellido2" required>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error' : form.cedula.$invalid && !form.cedula.$pristine }">
                            <label for="cedula" class="col-sm-4 control-label">Cedula</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Cédula" name="cedula" ng-model="userEdit.id" required>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error' : form.correo.$invalid && !form.correo.$pristine }">
                            <label for="correo" class="col-sm-4 control-label">Correo</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Correo" name="correo" ng-model="userEdit.correo" required>
                            </div>
                        </div>
                        <div  name="empresa" class="form-group"  ng-class="{ 'has-error' : form.empresa.$invalid && !form.empresa.$pristine }">
                            <label for="empresa" class="col-sm-4 control-label">Empresa: {{userEdit.empresa}}</label>
                            <div class="col-sm-8" ng-controller="controlEmpresa" ng-init="cargarSimple()">
                                <ui-select theme="bootstrap" ng-model="empresa" on-select="selectEmpresa($item)" class="form-control select2" title="Choose a person">
                                    <ui-select-match placeholder="">{{$select.selected.nombre}}</ui-select-match>
                                    <ui-select-choices repeat="empresa in empresas | filter: $select.search" >
                                        <div ng-bind-html="empresa.nombre | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>

                        </div>


                        <div class="form-group"  ng-class="{ 'has-error' : form.departamento.$invalid && form.departamento.$dirty }">
                            <label for="departamento" class="col-sm-4 control-label">Departamento: {{userEdit.departamento}}</label>                     
                            <div class="col-sm-8" ng-controller="controlDepartamento" ng-init="init()">
                                <ui-select theme="bootstrap"  ng-model="departamento.selected" on-select="update()" class="form-control select2" title="Choose a person">
                                    <ui-select-match placeholder="">{{$select.selected.nombre}}</ui-select-match>
                                    <ui-select-choices allow-clear ="true" repeat="departamento in departamentos | filter: $select.search | filter: filtro">
                                        <div ng-bind-html="departamento.nombre | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>


                        <div class="form-group" >
                            <label for="perfil" class="col-sm-4 control-label">Perfil</label>
                            <div class="col-sm-8">
                                <ui-select  multiple  class="form-control select2" ng-model="userEdit.perfil" close-on-select="false" style="width: 100%;" title="Choose a color" required>
                                    <ui-select-match placeholder="Seleccione los perfiles">{{$item}}</ui-select-match>
                                    <ui-select-choices repeat="a in opciones  |  filter: $select.search">
                                        {{a}}
                                    </ui-select-choices>
                                </ui-select>
                            </div> 
                        </div>
                        <div class="form-group">
                            <label for="estado" class="col-sm-4 control-label">Estado</label>
                            <div class="col-sm-3">
                                <input type="checkbox" id="" name="" ng-model="userEdit.estado" color="green"  i-check 
                                       ng-checked="userEdit.estado == 1" ng-true-value="'1'" ng-false-value="'0'">
                                <label for="" class="control-label">Activo</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="checkbox" id="" name="" ng-model="userEdit.estado" color="red"  i-check 
                                       ng-checked="userEdit.estado != 1" ng-true-value="'0'" ng-false-value="'1'">
                                <label for="" class="control-label">Inactivo</label>
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
</section>
<!-- /.content -->




<script>

</script>  