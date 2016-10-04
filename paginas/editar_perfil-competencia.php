<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Editar de Perfiles de Competencia
        <small>Blank example to the fixed layout</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_perfil-competencia">Perfil de Competencias</a></li>
        <li><a href="#/editar_perfil-competencia">Editar</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Competencias de Perfil {{perfil}} </h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body table-responsive">
                <div class="box-group" id="accordion">
                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">
                                    #1 Título de la Competencia
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in ">
                            <div class="box-body">
                                <!-- detalles-->
                                <div class="box-group" id="accordio">   
                                    <div class="panel box box-primary">
                                        <div class="box-header with-border">
                                            <h2 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordio" data-target="#collapse1">
                                                    #1 Detalle de la Competencia
                                                </a>
                                            </h2>
                                            <div id="collapse1" class="panel-collapse collapse ">
                                                <div class="box-body">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td>Descripción</td> 
                                                                <td>Peso</td>
                                                                <td><a class="btn btn-primary btn-block" href="#/">Editar </a></td>
                                                                <td><a class="btn btn-primary btn-block" href="#/"><i class="fa fa-close"></i> </a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel box box-primary">
                                        <div class="box-header with-border">
                                            <h2 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordio" data-target="#collapse2">
                                                    #2 Detalle de la Competencia
                                                </a>
                                            </h2>
                                            <div id="collapse2" class="panel-collapse collapse ">
                                                <div class="box-body">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td>Descripción</td> 
                                                                <td>Peso</td>
                                                                <td><a class="btn btn-primary btn-block" href="#/">Editar </a></td>
                                                                <td><a class="btn btn-primary btn-block" href="#/"><i class="fa fa-close"></i> </a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./detalles-->
                            </div>
                        </div>
                    </div>

                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo">
                                    #2 Título de la Competencia
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in">
                            <div class="box-body">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalCompetencia">Agregar Competencia </a>
                <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalDetalle">Agregar Detalle </a>
                <a class="btn btn-primary btn-lg pull-right" href="#/">Guardar </a>
            </div>
        </div>
        <!-- /.box-footer-->
    </div>
</section>
<!-- /.content -->

<!-- /.modal -->
<div class="modal" id="modalCompetencia">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar una Competencia</h4>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Agregar</button>
            </div>
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
                <h4 class="modal-title">Agregar una Detalle</h4>
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
                        <label for="peso" class="col-sm-2 control-label">Peso</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" placeholder="0" id="peso"> 
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<script type="text/javascript">
    $("tr").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
    });
</script>

