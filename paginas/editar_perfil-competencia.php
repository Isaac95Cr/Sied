<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Editar de Perfil de Competencia
        <small>Blank example to the fixed layout</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_perfil-competencia">Perfil de Competencias</a></li>
        <li><a href="#/editar_perfil-competencia">Editar</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="controlEditPerfil" ng-init="init()">
    <!-- Default box -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Competencias de Perfil {{perfil.nombre}} </h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body table-responsive">
                <div class="box-group" id="accordion">
                    <div class="panel box box-primary"  ng-repeat="competencia in perfil.competencias">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}" ng-click="selectCompetencia(competencia.id, competencia.titulo)">
                                    #{{$index + 1}} {{competencia.titulo}}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{$index}}" class="panel-collapse collapse" ng-class='{
                                in:$first}'>
                            <div class="box-body">
                                <b>Descripción:</b>
                                <p>{{competencia.descripcion}}</p>
                                <div class="box-group">   
                                    <table class="table table-bordered table-hover table-responsive">
                                        <thead>
                                        <th>Detalles de la competencia</th>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="detalle in competencia.detalles">
                                                <td>{{detalle.descripcion}}</td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                                <!-- ./detalles-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalCompetencia" ng-hide="!bandera">Agregar Competencia </a>
                <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalDetalle" ng-hide="bandera">Agregar Detalle </a>
            </div>
            <!-- /.box-footer-->
        </div>

    </div>

    <!-- /.modal -->
    <div class="modal" id="modalCompetencia">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar una Competencia</h4>
                </div>
                <form name="competenciaForm" method="post" class="form-horizontal" ng-submit="agregarCompetencia()" vnovalidate>
                    <div class="modal-body">

                        <div class="form-group" ng-class="{'has-error':competenciaForm.tituloCompetencia.$invalid && !competenciaForm.tituloCompetencia.$pristine }">
                            <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Titulo" id="titulo" name="tituloCompetencia"  ng-model="tituloCompetencia" required> 
                                <p ng-show="detalleForm.descripcionDetalle.$invalid && !detalleForm.descripcionDetalle.$pristine" class="help-block">Título de la competencia requerido.</p>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{'has-error':competenciaForm.descripcionCompetencia.$invalid && !competenciaForm.descripcionCompetencia.$pristine }">
                            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" placeholder="Descripción de la meta" id="descripcion" name="descripcionCompetencia"  ng-model="descripcionCompetencia" required></textarea>
                                <p ng-show="detalleForm.descripcionDetalle.$invalid && !detalleForm.descripcionDetalle.$pristine" class="help-block">Descripcion de la competencia requerido.</p>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{'has-error':competenciaForm.pesoCompetencia.$invalid && !competenciaForm.pesoCompetencia.$pristine }">
                            <label for="peso" class="col-sm-2 control-label">Peso</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" placeholder="0" step=0.01 id="peso" name="pesoCompetencia"  ng-model="pesoCompetencia" required>
                                <p ng-show="detalleForm.descripcionDetalle.$invalid && !detalleForm.descripcionDetalle.$pristine" class="help-block">Peso de la competencia requerido.</p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" ng-disabled="competenciaForm.$invalid" id="add-competencia">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->


    <!-- /.modal -->
    <div class="modal" id="modalDetalle">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar una Detalle a la competencia: {{competencia.titulo}}</h4>
                </div> 
                <form name="detalleForm" method="post" class="form-horizontal" ng-submit="agregarDetalle()" novalidate>
                    <div class="modal-body">

                        <div class="form-group" ng-class="{'has-error':detalleForm.descripcionDetalle.$invalid && !detalleForm.descripcionDetalle.$pristine }">
                            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" placeholder="Descripción de la competencia" name="descripcionDetalle" id="descripcion" ng-model="descripcionDetalle" required></textarea>
                                <p ng-show="detalleForm.descripcionDetalle.$invalid && !detalleForm.descripcionDetalle.$pristine" class="help-block">Descripcion del detalle requerido.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" ng-disabled="detalleForm.$invalid" id="add-detalle">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</section>
<!-- /.content -->



<script type="text/javascript">
            $("tr").click(function () {
                $(this).addClass("active").siblings().removeClass("active");
            });
            $('#add-detalle').click(function () {
                $('#modalDetalle').modal('toggle');
                return true;
            });
            $('#add-competencia').click(function () {
                $('#modalCompetencia').modal('toggle');
                return true;
            });
</script>

