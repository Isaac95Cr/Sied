<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Autoevaluar Competencias
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"></i> Índice</a></li>
        <li><a href="#/admin_competencias">Competencias</a></li>
        <li><a href="#/auto-evaluar_competencias">Autoevaluar Competencias</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="controlAutoEvCompetencias"  ng-init="init()">
    <!-- Default box -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> Autoevaluar Competencias</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body">
                <form name="formAutoEv" ng-submit="guardarAutoEvComp()" class="form-horizontal">
                    <div class="box-group" id="accordion">
                        <div class="panel box box-primary" ng-repeat="competencia in competencias">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                        <p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>">{{competencia.titulo}}</p>
                                    </a>
                                </h4>
                            </div>


                            <div id="collapse{{$index}}" class="panel-collapse collapse">
                                <div class="box-body table-responsive">
                                    <!-- detalles-->
                                    <table class="table table-bordered">
                                        <tr ng-repeat="detalle in competencia.detalles">
                                            <td>{{detalle.descripcion}}</td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="auto1" class="col-sm-3 control-label">Autoevaluación</label>
                                                    <div class="col-sm-3">
                                                        <input type="number" min="0" max="100" class="form-control" id={{detalle.id}} name={{competencia.id}} placeholder="0" id="auto1"> 
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- ./detalles-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" >    
                        <button type="submit" class="btn btn-primary btn-lg pull-right">Guardar Cambios</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box-footer-->
    </div>
</section>
<!-- /.content -->