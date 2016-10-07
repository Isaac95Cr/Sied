<!-- Content Header (Page header) -->

<section class="content-header">
    <h1>Administracion de Metas
        <small>Blank example to the fixed layout</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_metas">Metas</a></li>
    </ol>
    
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Metas</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body">
                <div class="box-group" id="accordion">
                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">
                                   <p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>"> #1 Título de la Meta </p>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in ">
                            <div class="box-body table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Descripción</td>
                                            <td>Peso</td>
                                            <td>AutoEvaluable</td>
                                            <td>Detalle</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalEdit">Editar</button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-block"><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo">
                                    <p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-success'>Aprobado</span></b>">#2 Título de la Meta</p>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="box-body table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Descripción</td>
                                            <td>Peso</td>
                                            <td>AutoEvaluable</td>
                                            <td>Detalle</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalEdit">Editar</button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-block"><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <div class="form-group">
                    <button type="button" class="btn btn-primary btn-lg pull-left" data-toggle="modal" data-target="#modalAdd">Agregar Meta</button>
                    <a type="button" class="btn btn-primary btn-lg pull-right" href="#/auto-evaluar_metas">Auto-Evaluar</a>
                    <button type="button" class="btn btn-primary btn-lg pull-right">Guardar cambios</button>

                </div>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
</section>
<!-- /.content -->

<!-- /modal -->
<div ng-controller="controlMeta" ng-init="init()">
<div class="modal" id="modalAdd">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar una Meta</h4>
            </div>
            <form ng-submit="agregar()"  class="form-horizontal">
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="titulo" class="col-sm-2 control-label">Título</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Titulo" id="titulo" ng-model="meta_titulo"> 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" placeholder="Descripción de la meta" id="descripcion" ng-model="meta_descripcion">
                            </textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="evaluable" class="col-sm-2 control-label" >Evaluable</label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="flat-blue"  id="evaluable" name="evaluable">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="peso" class="col-sm-2 control-label">Peso</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" placeholder="0" id="peso" ng-model="meta_peso"> 
                        </div>
                    </div>
                    
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
</form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
</div>
<!-- /.modal-dialog -->

<!-- /.modal -->
<div class="modal" id="modalEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar una Meta</h4>
            </div>
            <div class="modal-body">
                <form action="#/admin_metas" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Titulo" id="titulo"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" placeholder="Descripción de la meta" id="descripcion"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="evaluable" class="col-sm-2 control-label" >Evaluable</label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="flat-blue" id="evaluable" checked>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="peso" class="col-sm-2 control-label">Peso</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" placeholder="0" id="peso"> 
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<!-- /.modal -->



<script>
    $('input[type="checkbox"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
    });
     $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
        });
    });
    
    $('input').iCheck('check');
</script>