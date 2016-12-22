
<section class="content-header">
    <h1>Aprobar Metas
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
    </ol>
</section>

<!-- Main content -->
<div ng-controller="controlAprobarMetasRH" ng-init="init()">
    <section class="content">
        <!-- Default box -->
        <div class="col-md-12">
            <div class="box box-primary ">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Colaborador: </b> {{colaborador}}</h3>

                    <div class="box-tools pull-right">

                    </div>
                </div>

                <div class="box-body table-responsive">
                    <div class="box-group" id="accordion">

                        <div compile-data class="panel box box-primary" ng-repeat="meta in metasUser">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                        <p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>">{{meta.titulo}}</p>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{$index}}" class="panel-collapse collapse">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td style="font-weight: bold;">Descripción</td>
                                            <td style="font-weight: bold;">Peso</td>
                                            <td style="font-weight: bold;">Estado</td>
                                            <td style="font-weight: bold;">Comentario</td>
                                        </tr>

                                        <tr style="text-align: center;">
                                            <td> {{meta.descripcion}} </td>
                                            <td> {{meta.peso}} </td>                                       
                                            <td class="text-center">
                                                <div class="form-group">

                                                    <div class="col-sm-3">
                                                        <p>Aprobada</p>
                                                        <input type="checkbox" id="{{'a'+$index}}" name="" 
                                                               ng-model="meta.aprobacion_rh" ng-checked="meta.aprobacion_rh == 1" ng-change="comprobarAprobado('a'+$index, meta.id)"
                                                               ng-true-value="'1'" ng-false-value="'0'"   color="green" i-check>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <p>Desaprobada</p>
                                                        <input type="checkbox" id="{{'d'+$index}}" name=""
                                                               ng-change="comprobarDesaprobado('d'+$index, meta.id)"
                                                               ng-model="meta.aprobacion_rh" ng-checked="meta.aprobacion_rh == 0"
                                                               ng-true-value="'0'" ng-false-value="'1'" color="red" i-check >
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <span data-toggle="modal" data-target="#modalVerComent">
                                                    <i class="fa fa-commenting fa-2x" ng-click="getComment(meta.id)"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                    <p style="font-size: 90%" ng-show="!tiene_Metas" class="label bg-red margin">El Colaborador no posee metas</p>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer" >
                </div>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->


    <!-- /.modal -->
    <div class="modal" id="modalComent">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color:#FFF">
                    <button type="button" style='opacity: initial; color: #FFF' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Comentario de la Meta</h4>
                </div>
                <div class="modal-body">

                    <form name="formComentar" class="form-horizontal" novalidate>
                        <div class="form-group" ng-class="{ 'has-error' : formComentar.comentario.$invalid && !formComentar.comentario.$pristine }">
                            <label for="comment" class="col-sm-2 control-label">Comentario</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" placeholder="Comentario de la meta" id="comentario" ng-model="comentario" name="comentario" required>
                                </textarea>
                                <p ng-show="formComentar.comentario.$invalid && !formComentar.comentario.$pristine" class="help-block">Comentario de meta requerido.</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left"  data-dismiss="modal">Cancelar</button>
                            <button type="button"  class="btn btn-primary" ng-disabled="formComentar.$invalid" data-dismiss="modal" ng-click="desaprobarMeta()">Guardar</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->




    <div class="modal" id="modalVerComent">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color:#FFF">
                    <button type="button" style='opacity: initial; color: #FFF' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Comentario de la Meta</h4>
                </div>
                <div class="modal-body">

                    <form name="formMuestra" class="form-horizontal" novalidate>
                        <div class="form-group">
                            <label for="comment" class="col-sm-2 control-label">Comentario</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" ng-model="commentIcono" id="comentario" name="comentario" ng-disabled="true" style="color: red">
                                </textarea>
                                <p ng-show="commentIcono === null || commentIcono === '' " style="color:green">*La meta no posee comentarios</p>
                            </div>
                        </div>

                        <div class="modal-footer">
      
                            <button type="button"  class="btn btn-primary"data-dismiss="modal">Aceptar</button>
                        </div>
                    </form>




                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>





    <!-- /.modal -->
</div>

<script>
//    $('input[type="checkbox"].flat-green').iCheck({
//        checkboxClass: 'icheckbox_flat-green'
//    });
//    $('input[type="checkbox"].flat-red').iCheck({
//        checkboxClass: 'icheckbox_flat-red'
//    });
//    $('input[type="checkbox"]').on('ifChecked', function () {
//        $('input[name="' + this.name + '"]').not(this).iCheck('uncheck');
//    });
//    $('input[type="checkbox"]').on('ifUnchecked', function () {
//        $('input[name="' + this.name + '"]').not(this).iCheck('check');
//    });
//    var ultimo;
//    $('input[type="checkbox"].flat-red').on('ifChecked', function () {
//        $('#modalComent').modal();
//        ultimo = this;
//    });
//    $('#cancelar').on('click', function () {
//        $('input[name="' + ultimo.name + '"]').iCheck('uncheck');
//    });
//    $(document).ready(function () {
//        $('[data-toggle="popover"]').popover({
//        });
//        $('[data-toggle="tooltip"]').tooltip();
//    });

    //$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });




</script>
