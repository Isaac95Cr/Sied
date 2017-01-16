
<section class="content-header">
    <h1>Detalle de Metas de Colaborador  
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_metas">Metas</a></li>
    </ol>
</section>



<!-- Main content -->
<div ng-controller="controlDetalleMetasRH" ng-init="init()">
    <section class="content">
        <!-- Default box -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Colaborador: </b> {{colaborador}}</h3>

                    <div class="box-tools pull-right">

                    </div>
                </div>
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <div class="panel box box-primary" ng-repeat="meta in metasUser" ng-if="meta.aprobacion_j === '1' && meta.aprobacion_rh === null">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                        <p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>">{{meta.titulo}}</p>
                                    </a>
                                </h4>
                            </div>

                            <div id="collapse{{$index}}" class="panel-collapse collapse">
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered" style="table-layout: fixed; word-wrap: break-word;">
                                        <tr>
                                            <td style="font-weight: bold;">Descripción</td>
                                            <td style="font-weight: bold;">Peso</td>
                                        </tr>
                                        <tr>
                                            <td>{{meta.descripcion}}</td>
                                            <td>{{meta.peso}}</td>
                                        </tr>

                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>

                    <p style="font-size: 90%" ng-show="!tiene_Metas" class="label bg-red margin">El Colaborador no posee metas</p>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer" >    
                    <div class="form-group">

                        <a type="button" ng-show="tiene_Metas" class="btn btn-primary btn-lg pull-right" href="#/admin_colab_metas_RH">Aceptar</a>
                    </div>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
    </section>
    <!-- /.content -->




</div>



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

