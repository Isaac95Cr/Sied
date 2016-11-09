

<section class="content-header">
    <h1>Evaluar Metas
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_colaboradores_metas">Colaboradores</a></li>
        <li><a href="#/evaluar_metas">Evaluar Metas</a></li>
    </ol>
</section>


<!-- Main content -->
<div ng-controller="controlEvaluarMetas" ng-init="init()">
    <section class="content">
        <!-- Default box -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Colaborador: </b> {{colaborador}}</h3>

                    <div class="box-tools pull-right">

                    </div>
                </div>
                <div class="box-body">
                    <form name="formAutoEv" ng-submit="confirmarEvaluacion()" class="form-horizontal">
                        <div class="box-group" id="accordion">
                            <div class="panel box box-primary" ng-repeat="meta in metasUser" ng-if="meta.evaluable === '1'">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                            <p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>">{{meta.titulo}}</p>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$index}}" class="panel-collapse collapse">
                                    <div class="box-body table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td style="font-weight: bold;">Descripción</td>
                                                <td style="font-weight: bold;">Peso</td>
                                                <td style="font-weight: bold;">Autoevaluación</td>
                                                <td style="font-weight: bold;">Evaluación</td>
                                            </tr>

                                            <tr style="text-align: center;">
                                                <td> {{meta.descripcion}} </td>
                                                <td> {{meta.peso}} </td>
                                                <td> {{meta.auto_evaluacion == null? 'Pendiente' : meta.auto_evaluacion}}</td>
                                                <td>
                                                    <div class="form-group" >
                                                        <div class="col-sm-4">
                                                            <input type="number" min="0" max="100" class="form-control" style="text-align: center;" placeholder="0" id={{meta.id}} name={{meta.id}} ng-value={{meta.evaluacion}} > 
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="box-footer" >
                            <button type="submit" class="btn btn-primary btn-lg pull-right" ng-show="tiene_Metas">Guardar cambios</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<script>

</script>
