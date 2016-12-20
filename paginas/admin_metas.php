
<section class="content-header">
    <h1>Administración de Metas     
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_metas">Metas</a></li>
    </ol>
</section>




<!-- Main content -->
<div ng-controller="controlMeta" ng-init="init()">
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
                        <div class="panel box box-primary" ng-repeat="meta in metas">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                        <p popover data-toggle="popover" data-trigger="hover" data-container="body" data-html="true" data-content="<b>Jefe: <span class='label label-primary'>{{meta.aprobacion_j == 1? 'Aprobada' : 'Desaprobada'}}</span> <br> RRHH: <span class='label label-primary'>{{meta.aprobacion_rh == 1? 'Aprobada' : 'Desaprobada'}}</span></b>">{{meta.titulo}}</p>
                                    </a>
                                </h4>
                            </div>

                            <div id="collapse{{$index}}" class="panel-collapse collapse">
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td style="font-weight: bold;">Descripción</td>
                                            <td style="font-weight: bold;">Peso</td>
                                            <td style="font-weight: bold;">Autoevaluable</td>
                                            <td style="font-weight: bold;">Editar</td>
                                            <td style="font-weight: bold;">Eliminar</td>
                                        </tr>
                                        <tr>
                                            <td> {{meta.descripcion}}</td>
                                            <td> {{meta.peso}} </td>
                                            <td> {{meta.evaluable == 1? 'Sí' : 'No'}} </td>
                                            <td>
                                                <button type="button" id={{meta.id}} name={{meta.id}} value={{meta.id}} ng-click="updateActual(meta)"   class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalEdit"><i class="fa fa-clipboard"></i></button>
                                            </td>
                                            <td>
                                                <button type="button" id={{meta.id}} name={{meta.id}} value={{meta.id}} ng-click="confirmarEliminacion(meta.id)"  class="btn btn-primary btn-block"><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>

                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer" >    
                    <button  class="btn btn-primary btn-lg pull-left" ng-click="resetValues()" data-toggle="modal" data-target="#modalMeta" style="margin-right: 10px;">Agregar Meta</button>
                    <button ng-show="tiene_Metas" class="btn btn-primary btn-lg pull-left" ng-click="" data-toggle="modal" data-target="#modalPeso">Editar Pesos</button>
                    <a type="button" ng-show="tiene_Metas"  class="btn btn-primary btn-lg pull-right" href="#/auto-evaluar_metas">Autoevaluar</a>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
    </section>
    <!-- /.content -->





    <!-- /modal -->
    <div>
        <div class="modal" id="modalMeta">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="reset" class="close" ng-click="resetForm(metaForm)" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Agregar una Meta</h4>
                    </div>
                    <form id="metaForm" name="metaForm" ng-submit="agregar(metaForm)"  class="form-horizontal" novalidate>
                        <div class="modal-body">

                            <div class="form-group" ng-class="{ 'has-error' : metaForm.meta_titulo.$invalid && !metaForm.meta_titulo.$pristine }">
                                <label for="titulo" class="col-sm-2 control-label">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Título" id="titulo" ng-model="meta_titulo" name="meta_titulo" required>
                                    <p ng-show="metaForm.meta_titulo.$invalid && !metaForm.meta_titulo.$pristine" class="help-block">Título de meta requerido.</p>
                                </div>
                            </div>

                            <div class="form-group" ng-class="{ 'has-error' : metaForm.meta_descripcion.$invalid && !metaForm.meta_descripcion.$pristine }">
                                <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="Descripción de la meta" id="descripcion" ng-model="meta_descripcion" name="meta_descripcion" required>
                                    </textarea>
                                    <p ng-show="metaForm.meta_descripcion.$invalid && !metaForm.meta_descripcion.$pristine" class="help-block">Descripción de meta requerida.</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="evaluable" class="col-sm-2 control-label" >Evaluable</label>
                                <div class="col-sm-10">
                                    <input type="checkbox"  id="evaluable" name="evaluable" ng-model="is_Check"  i-check />
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="reset" ng-click="resetForm(metaForm)" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" ng-disabled="metaForm.$invalid" id="add-meta"  class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal-dialog -->





    <!-- /.modal -->
    <div>
        <div class="modal" id="modalEdit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Editar una Meta</h4>
                    </div>
                    <div class="modal-body">
                        <form name="formModif" ng-submit="modificar()" class="form-horizontal">
                            <div class="form-group" ng-class="{ 'has-error' : formModif.meta_titulo.$invalid && !formModif.meta_titulo.$pristine }">
                                <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Titulo" id="titulo" ng-model="meta_titulo" name="meta_titulo" required> 
                                    <p ng-show="formModif.meta_titulo.$invalid && !formModif.meta_titulo.$pristine" class="help-block">Título de meta requerido.</p>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{ 'has-error' : formModif.meta_descripcion.$invalid && !formModif.meta_descripcion.$pristine }">
                                <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="Descripción de la meta" id="descripcion" ng-model="meta_descripcion" name="meta_descripcion" required>
                                    </textarea>
                                    <p ng-show="formModif.meta_descripcion.$invalid && !formModif.meta_descripcion.$pristine" class="help-block">Descripción de meta requerida.</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="evaluable" class="col-sm-2 control-label" >Evaluable</label>
                                <div class="col-sm-10">
                                    <input type="checkbox"  id="evaluable" name="evaluable" ng-model="is_Check"  i-check />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                <button type="submit" ng-disabled="formModif.$invalid" id="modify-meta" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>    





<!-- /.modalPesos -->
<div class="modal" id="modalPeso" ng-controller="controlPesosMetas">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar los Pesos de las metas</h4>
            </div> 
            <form name="pesoForm" method="post" class="form-horizontal" ng-submit="setPesosMetas()" novalidate>
                <div class="modal-body">
                    <div ng-repeat="meta in metas">
                        <div class="form-group" ng-class="{'has-error':pesoForm.peso{{$index}}.$invalid && !pesoForm.peso{{$index}}.$pristine }">
                            <label for="peso" class="col-sm-8 control-label">Peso de meta {{meta.titulo}} </label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" string-to-number step=0.01 min="0" max="100" id="peso" name="peso{{$index}}"  ng-model="meta.peso" ng-change="getTotal()" required>
                                <p ng-show="pesoForm.peso{{$index}}.$invalid && !pesoForm.peso{{$index}}.$pristine" class="help-block">Peso de la meta requerido.</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{'has-error':pesoForm.pesoTotal.$invalid}">
                        <label for="peso" class="col-sm-8 control-label">Total</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" placeholder="0" step=1 id="peso" name="pesoTotal" min="100" max="100" ng-model="sumaTotal" required >
                            <p ng-show="pesoForm.pesoTotal.$invalid" class="help-block">*La suma de los pesos debe ser 100</p>
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


<!--</div>-->



<script>
    $(document).ready(function () {
    $('[data-toggle="popover"]').popover({
    });
    });
    $('#add-meta').click(function () {
    $('#modalMeta').modal('toggle');
    return true;
    });
    $('#modify-meta').click(function () {
    $('#modalEdit').modal('toggle');
    return true;
    });
</script>