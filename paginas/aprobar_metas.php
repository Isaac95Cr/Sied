
<section class="content-header">
    <h1>Aprobar Metas
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_colaboradores_metas">Colaboradores</a></li>
        <li><a href="#/aprobar_metas">Aprobar Metas</a></li>
    </ol>
</section>

<!-- Main content -->
<div ng-controller="controlAprobarMetas" ng-init="init()">
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
                        
                        <div compile-data class="panel box box-primary" ng-repeat="meta in metasUser" ng-if="meta.evaluable === '1'">
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
<!--                                                        <div class="col-sm-3" style="text-align: center;">
                                                            <input type="checkbox" class="flat-green" id="evaluable{{$index}}" name="meta{{$index}}" checked>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="checkbox" class="flat-red" id="evaluable{{$index}}" name="meta{{$index}}" >
                                                        </div>-->

                                                        <div class="col-sm-3">
                                                         <p>Aprobada<p>
                                                            <input type="checkbox" id="" name="" 
                                                                ng-model="aprobada" ng-checked="aprobada === 1" 
                                                                ng-true-value="'1'" ng-false-value="'0'"   color="green" i-check checked>
                                                        </div>

                                                        <div class="col-sm-3">
                                                         <p>Desaprobada<p>
                                                         <input type="checkbox" id="" name="" 
                                                                ng-model="aprobada" ng-checked="aprobada !== 0" 
                                                                ng-true-value="'0'" ng-false-value="'1'"   color="red" i-check>
                                                        </div>

                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <span data-toggle="modal" data-target="#modalComent">
                                                        <i class="fa fa-commenting fa-2x"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        
                        


<!-- Sin Angular -->
<!--                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">
                                        <p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>">Titulo</p>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                            <tr>
                                                <td style="font-weight: bold;">Descripción</td>
                                                <td style="font-weight: bold;">Peso</td>
                                                <td style="font-weight: bold;">Estado</td>
                                                <td style="font-weight: bold;">Comentario</td>
                                            </tr>

                                            <tr>
                                                <td> Prueba</td>
                                                <td> Peso </td>                                       
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <div class="col-sm-3">
                                                            <input type="checkbox" class="flat-green" id="evaluable1" name="meta1" checked>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="checkbox" class="flat-red" id="evaluable1" name="meta1" >
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <span data-toggle="modal" data-target="#modalComent">
                                                        <i class="fa fa-commenting fa-2x"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        </div>-->








                        
                        
                        
<!--              <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">
                                        <p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>">titulo</p>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td style="font-weight: bold;">Descripción</td>
                                                <td style="font-weight: bold;">Peso</td>
                                                <td style="font-weight: bold;">Estado</td>
                                                <td style="font-weight: bold;">Comentario</td>
                                            </tr>

                                            <tr>
                                                <td> descripcion </td>
                                                <td> peso</td>                                       
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <div class="col-sm-3">
                                                            <input type="checkbox" class="flat-green" id="evaluable" name="meta4" checked>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="checkbox" class="flat-red" id="evaluable" name="meta4">
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <span data-toggle="modal" data-target="#modalComent">
                                                        <i class="fa fa-commenting fa-2x"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>-->
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        


<!--                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo">
                                        #2 Título de la Meta
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse ">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Descripción</td>
                                                <td>Peso</td>
                                                <td>Evaluable</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <div class="col-sm-3">
                                                            <input type="checkbox" class="flat-green" id="evaluable" name="meta4" checked>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="checkbox" class="flat-red" id="evaluable" name="meta4" >
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span>
                                                        <i class="fa fa-commenting fa-2x"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>-->
                        


                        <div class="panel box box-danger">
                            <div class="box-header with-border" >
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseThree" >
                                        #3 Título de la Meta
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse ">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Descripción</td>
                                                <td>Peso</td>
                                                <td>Evaluable</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-3">
                                                            <input type="checkbox" class="flat-green" id="evaluable" name="meta3" checked>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="checkbox" class="flat-red" id="evaluable" name="meta3">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span data-toggle="modal" data-target="#modalComent">
                                                        <i class="fa fa-commenting fa-2x"></i>
                                                    </span>
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
                    <button type="button" class="btn btn-primary btn-lg pull-right">Guardar cambios</button>
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
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Comentario de la Meta</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-horizontal"> 
                        <div class="form-group">
                            <label for="comentario" class="col-sm-2 control-label">Comentario</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" placeholder="" id="comentario"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="cancelar">Cancelar</button>
                    <button type="button" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->


    <!-- /.modal -->
</div>

<script>
    $('input[type="checkbox"].flat-green').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-red'
    });
    $('input[type="checkbox"]').on('ifChecked', function () {
        $('input[name="' + this.name + '"]').not(this).iCheck('uncheck');
    });
    $('input[type="checkbox"]').on('ifUnchecked', function () {
        $('input[name="' + this.name + '"]').not(this).iCheck('check');
    });
    var ultimo;
    $('input[type="checkbox"].flat-red').on('ifChecked', function () {
        $('#modalComent').modal();
        ultimo = this;
    });
    $('#cancelar').on('click', function () {
        $('input[name="' + ultimo.name + '"]').iCheck('uncheck');
    });
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
        });
        $('[data-toggle="tooltip"]').tooltip();
    });

    //$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
</script>