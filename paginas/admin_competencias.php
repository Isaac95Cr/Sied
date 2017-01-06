
<section class="content-header">
    <h1>Administración de Competencias
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_competencias">Competencias</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="cntrlCompetenciasColab"  ng-init="init()">
    <!-- Default box -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Competencias</h3>
                <br /><br />
                <h3 class="box-title" ng-show="tiene_Perfil">Perfil de Competencias: <b>{{nombrePerfil}}</b></h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body">
                <div class="box-group" id="accordion">
                    <div class="panel box box-primary" ng-repeat="competencia in competencias">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                    <p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>">{{competencia.titulo}}</p>
                                </a>
                            </h4>
                        </div>


                        <div id="collapse{{$index}}" class="panel-collapse collapse ">
                            <div class="box-body table-responsive">
                                <!-- detalles-->
                                <div class="box-group" id="accordio">
                                    <b>Descripción:</b>
                                    <p>{{competencia.descripcion}}</p>
                                    <table class="table table-bordered">
                                        <th>Detalles de la competencia</th>

                                        <tr ng-repeat="detalle in competencia.detalles">
                                            <td>{{detalle.descripcion}}</td>
                                        </tr>

                                    </table>
                                </div>
                                <!-- ./detalles-->
                            </div>
                        </div>
                    </div>
                    
                    <p style="font-size: 90%" ng-show="!tiene_Perfil"  class="label label-danger margin">No tiene un perfil de competencia asociado</p>
                    <p style="font-size: 90%" ng-show="tiene_Perfil && !tiene_Competencias"  class="label label-danger margin">No existen competencias asociadas a su perfil</p>

                </div>

                <div class="box-footer">    
                    <a class="btn btn-primary btn-lg pull-right" ng-show="tiene_Todo" href="#/auto-evaluar_competencias">Autoevaluar</a>
                </div>

            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box-footer-->
    </div>
</section>
<!-- /.content -->