<!-- Content Header (Page header) -->

<section class="content-header">
    <h1>Administración de Empresas y Departamentos
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_empresa">Empresa</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="col-md-6" ng-controller="controlEmpresa" ng-init="init()">
        <div class="box box-primary">
            <div class="box-header with-border ">
                <h3 class="box-title">Empresas</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr ng-repeat="empresa in empresas" sglclick="selectEmpresa({{empresa}})" dblclick="modalModificar({{empresa}});">
                        <td> {{empresa.nombre}} </td>
                        <td style="text-align:center"><a ng-click="confirmar(empresa.id)" class=""><i class="fa fa-close"></i>  </a> </td>
                    </tr>
                </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalEmpresaAdd">Agregar</a>
            </div>
        </div>
        <!-- /.box-footer-->
        <!-- /.modalAgregar -->
        <div class="modal" id="modalEmpresaAdd">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="reset" class="close" data-dismiss="modal" ng-click="resetForm(empresaAddForm)" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Agregar Empresa </h4>
                    </div>
                    <form id="empresaAddForm" name="empresaAddForm" class="form-horizontal" ng-submit="agregar(empresaAddForm)" novalidate> 
                        <div class="modal-body">

                            <div class="form-group" ng-class="{ 'has-error' : empresaAddForm.empresaAdd.$invalid && !empresaAddForm.empresaAdd.$pristine}">
                                <label for="empresa" class="col-sm-2 control-label">Empresa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nombre" id="empresa" ng-model="empresaAdd.nombre" name="empresaAdd" required>
                                    <p ng-show="empresaAddForm.empresaAdd.$invalid && !empresaAddForm.empresaAdd.$pristine" class="help-block">Nombre de empresa requerido.</p>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default pull-left" ng-click="resetForm(empresaAddForm)" data-dismiss="modal" id="cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-primary" ng-disabled="empresaAddForm.$invalid" closemodal="modalEmpresaAdd">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <!-- /.modalEditar -->
        <div class="modal" id="modalEmpresaEdit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Editar Empresa {{empresa.nombre}} </h4>
                    </div>
                    <form name="empresaEditForm" class="form-horizontal" ng-submit="modificar()" novalidate> 
                        <div class="modal-body">

                            <div class="form-group" ng-class="{ 'has-error' : empresaEditForm.empresaEdit.$invalid && !empresaEditForm.empresaEdit.$pristine}">
                                <label for="empresa" class="col-sm-2 control-label">Empresa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nombre" id="empresa" ng-model="empresaEdit.nombre" name="empresaEdit" required>
                                    <p ng-show="empresaEditForm.empresaEdit.$invalid && !empresaEditForm.empresaEdit.$pristine" class="help-block">Nombre de empresa requerido.</p>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-primary" ng-disabled="empresaEditForm.$invalid" closemodal="modalEmpresaEdit">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->

    </div>


    <div class="col-md-6" ng-controller="controlDepartamento" ng-init="init()">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Departamentos de Empresa: {{empdep.getEmpresa().nombre}}</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr ng-repeat="departamento in departamentos | filter: filtro" sglclick="" dblclick="modalModificar({{departamento}});">
                        <td> {{departamento.nombre}}</td>
                        <td style="text-align:center"><a ng-click="confirmar(departamento.id)"><i class="fa fa-close"></i>  </a> </td>
                    </tr>
                </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalDepartamentoAdd">Agregar </a>
            </div>
        </div>
        <!-- /.box-footer-->
        <!-- /.modalAgregar -->
        <div class="modal" id="modalDepartamentoAdd">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="reset" class="close" ng-click="resetForm(departamentoFormAdd)"  data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Agregar Departamento</h4>
                    </div>
                    <form id="departamentoFormAdd" name="departamentoFormAdd" class="form-horizontal" ng-submit="agregar(departamentoFormAdd)" novalidate> 
                        <div class="modal-body">

                            <div class="form-group" ng-class="{ 'has-error' : departamentoFormAdd.departamentoAdd.$invalid && !departamentoFormAdd.departamentoAdd.$pristine }">
                                <label for="departamento" class="col-sm-2 control-label">Departamento</label>
                                <div class="col-sm-10">
                                    <input class="form-control" placeholder="Nombre" id="departamento" name="departamentoAdd" ng-model="departamentoAdd.nombre" required>
                                    <p ng-show="departamentoFormAdd.departamentoAdd.$invalid && !departamentoFormAdd.departamentoAdd.$pristine" class="help-block">Nombre del departamento.</p>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default pull-left" ng-click="resetForm(departamentoFormAdd)" data-dismiss="modal" id="cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-primary" ng-disabled="departamentoFormAdd.$invalid"  closemodal="modalDepartamentoAdd">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <!-- /.modalEditar -->
        <div class="modal" id="modalDepartamentoEdit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Editar Departamento {{departamento.nombre}}</h4>
                    </div>
                    <form name="departamentoFormEdit" class="form-horizontal" ng-submit="modificar()" novalidate> 
                        <div class="modal-body">

                            <div class="form-group" ng-class="{ 'has-error' : departamentoFormEdit.departamentoEdit.$invalid && !departamentoFormEdit.departamentoEdit.$pristine }">
                                <label for="departamento" class="col-sm-2 control-label">Departamento</label>
                                <div class="col-sm-10">
                                    <input class="form-control" placeholder="Nombre" id="departamento" name="departamentoEdit" ng-model="departamentoEdit.nombre" required>
                                    <p ng-show="departamentoFormEdit.departamentoEdit.$invalid && !departamentoFormEdit.departamentoEdit.$pristine" class="help-block">Nombre del departamento.</p>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-primary" ng-disabled="departamentoFormEdit.$invalid"  closemodal="modalDepartamentoEdit">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</section>
<!-- /.content -->







<!-- /.modal -->

<script type="text/javascript">
    $("tr").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
    });

</script>

