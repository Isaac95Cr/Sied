<!-- Content Header (Page header) -->

<section class="content-header">
    <h1>Aprobar Metas
        <small>Blank example to the fixed layout</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_colaboradores_metas">Colaboradores</a></li>
        <li><a href="#/aprobar_metas">Aprobar Metas</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="col-md-12">
        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Metas</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body table-responsive">
                <div class="box-group" id="accordion">
                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">
                                    #1 Título de la Meta
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in ">
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
                                                        <input type="checkbox" class="flat-green checkbox" name="meta1" checked>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="checkbox" class="flat-red" name="meta1" >                                                        
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
                    </div>

                    <div class="panel box box-primary">
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
                                            <td>
                                                <div class="form-group">
                                                    <div class="col-sm-3">
                                                        <input type="checkbox" class="flat-green" id="evaluable" name="meta2" checked>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="checkbox" class="flat-red" id="evaluable" name="meta2" >
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
                    </div>

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
                                                        <input type="checkbox" class="flat-green" id="evaluable" name="meta3" >
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="checkbox" class="flat-red" id="evaluable" name="meta3" checked>
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