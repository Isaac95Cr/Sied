<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Editar de Perfil de Competencia
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
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}" ng-click="selectCompetencia(competencia.id, competencia.titulo, competencia.descripcion);">
                                    {{competencia.titulo}}
                                </a>
                            </h4>
                            <div class="box-tools pull-right">
                               <!-- <a ng-click="modalModificarCompetencia(competencia.id, competencia.titulo, competencia.descripcion)"><i class="fa fa-pencil fa-lg fa-fw" ></i></a>
                                -->
                            </div>
                        </div>
                        <div id="collapse{{$index}}" class="panel-collapse collapse">
                            <div class="box-body">
                                <table class="table table-responsive table-hover">
                                    <tr sglclick="" dblclick="modalModificarCompetencia({{detalle}});">
                                        <td>
                                            <b>Descripción:</b>
                                            <p>{{competencia.descripcion}}</p>
                                        </td>
                                    </tr>
                                </table>
                                <div class="box-group">   
                                    <table class="table table-bordered table-hover table-responsive">
                                        <thead>
                                        <th>Detalles de la competencia</th>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="detalle in competencia.detalles" sglclick="" dblclick="modalModificarDetalle({{detalle}});">
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
                 <p style="font-size: 90%" ng-show="perfil.competencias.length == 0" class="label bg-red margin">Este perfil no posee competencias</p>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalCompetencia" ng-show="bandera">Agregar Competencia </a>
                <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalDetalle" ng-show="!bandera">Agregar Detalle </a>                    
                
                <a class="btn btn-primary btn-lg pull-left" ng-show="hayCompetencias"  data-toggle="modal" data-target="#modalPeso">Asignar pesos <span ng-show="pesoBool" class="label label-danger">!</span> </a>
<!--                <a class="btn btn-primary btn-lg pull-left" ng-click="pesoBool = false;" data-toggle="modal" data-target="#modalPeso">Asignar pesos <span ng-show="pesoBool" class="label label-danger">!</span> </a>-->


            </div>
            <!-- /.box-footer-->
        </div>

    </div>

    <!-- /.modalAgregarCompetencia -->
    <div class="modal" id="modalCompetencia">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color:#FFF">
                    <button type="reset" style='opacity: initial; color: #FFF' class="close" data-dismiss="modal" ng-click="resetForm(competenciaForm)" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar una Competencia</h4>
                </div>
                <form id="competenciaForm" name="competenciaForm" method="post" class="form-horizontal" ng-submit="agregarCompetencia(competenciaForm)" vnovalidate>
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
                                <p ng-show="detalleForm.descripcionDetalle.$invalid && !detalleForm.descripcionDetalle.$pristine" class="help-block">Descripción de la competencia requerido.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default pull-left" ng-click="resetForm(competenciaForm)" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" ng-disabled="competenciaForm.$invalid" closemodal="modalCompetencia">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <!-- /.modalEditarCompetencia -->
    <div class="modal" id="modalCompetenciaEdit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color:#FFF">
                    <button type="button" style='opacity: initial; color: #FFF' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar una Competencia</h4>
                </div>
                <form name="competenciaFormEdit" method="post" class="form-horizontal" ng-submit="modificarCompetencia()" vnovalidate>
                    <div class="modal-body">

                        <div class="form-group" ng-class="{'has-error':competenciaFormEdit.tituloCompetenciaEdit.$invalid && !competenciaFormEdit.tituloCompetenciaEdit.$pristine }">
                            <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Titulo" id="titulo" name="tituloCompetencia"  ng-model="tituloCompetenciaEdit" required> 
                                <p ng-show="competenciaFormEdit.tituloCompetenciaEdit.$invalid && !competenciaFormEdit.tituloCompetenciaEdit.$pristine" class="help-block">Título de la competencia requerido.</p>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{'has-error':competenciaFormEdit.descripcionCompetencia.$invalid && !competenciaFormEdit.descripcionCompetencia.$pristine }">
                            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" placeholder="Descripción de la competencia" id="descripcion" name="descripcionCompetencia"  ng-model="descripcionCompetenciaEdit" required></textarea>
                                <p ng-show="competenciaFormEdit.descripcionCompetenciaEdit.$invalid && !competenciaFormEdit.descripcionCompetenciaEdit.$pristine" class="help-block">Descripcion de la competencia requerido.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" ng-disabled="competenciaFormEdit.$invalid" closemodal="modalCompetenciaEdit">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <!-- /.modalAgregarDetalle -->
    <div class="modal" id="modalDetalle">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color:#FFF">
                    <button type="button" style='opacity: initial; color: #FFF' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar un Detalle a la competencia: {{competencia.titulo}}</h4>
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
                        <button type="submit" class="btn btn-primary" ng-disabled="detalleForm.$invalid" closemodal="modalDetalle">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <!-- /.modalEditarDetalle -->
    <div class="modal" id="modalDetalleEdit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color:#FFF">
                    <button type="button" style='opacity: initial; color: #FFF' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Detalle de la competencia: {{competencia.titulo}}</h4>
                </div> 
                <form name="detalleFormEdit" method="post" class="form-horizontal" ng-submit="modificarDetalle()" novalidate>
                    <div class="modal-body">

                        <div class="form-group" ng-class="{'has-error':detalleFormEdit.descripcionDetalleEdit.$invalid && !detalleFormEdit.descripcionDetalleEdit.$pristine }">
                            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" placeholder="Descripción de la competencia" name="descripcionDetalleEdit" id="descripcion" ng-model="descripcionDetalleEdit" required></textarea>
                                <p ng-show="detalleFormEdit.descripcionDetalleEdit.$invalid && !detalleFormEdit.descripcionDetalleEdit.$pristine" class="help-block">Descripcion del detalle requerido.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" ng-disabled="detalleFormEdit.$invalid" closemodal="modalDetalleEdit">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <!-- /.modalPesos -->
    <div class="modal" id="modalPeso" ng-controller="controlPesos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color:#FFF">
                    <button type="button" style='opacity: initial; color: #FFF' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar los Pesos de las competencias</h4>
                </div> 
                <form name="pesoForm" method="post" class="form-horizontal" ng-submit="modificarPeso()" novalidate>
                    <div class="modal-body">
                        <div ng-repeat="competencia in competencias">
                            <div class="form-group" ng-class="{'has-error':pesoForm.peso{{$index}}.$invalid && !pesoForm.peso{{$index}}.$pristine }">
                                <label for="peso" class="col-sm-8 control-label">Peso de competencia {{competencia.titulo}} </label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" string-to-number step=0.01 min="0" max="100" id="peso" name="peso{{$index}}"  ng-model="competencia.peso" ng-change="getTotal()" required>
                                    <p ng-show="pesoForm.peso{{$index}}.$invalid && !pesoForm.peso{{$index}}.$pristine" class="help-block">Peso de la competencia requerido.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{'has-error':pesoForm.pesoTotal.$invalid}">
                            <label for="peso" class="col-sm-8 control-label">Total</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" placeholder="0" step=0.01 id="peso" name="pesoTotal" min="100" max="100" ng-model="sum" required disabled>
                                <p ng-show="pesoForm.pesoTotal.$invalid" class="help-block">La suma de los pesos debe ser 100</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" ng-disabled="pesoForm.$invalid" closemodal="modalPeso">Guardar Cambios</button>
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
</script>

