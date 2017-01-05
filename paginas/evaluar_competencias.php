
<section class="content-header">
    <h1>Evaluar Competencias
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_colaboradores_competencias">Colaboradores</a></li>
        <li><a href="#/evaluar_competencias">Evaluar Competencias</a></li>
    </ol>
</section>

<!-- Main content -->
<div ng-controller="controlEvaluarCompet" ng-init="init()">
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
                    <form name="formEvCompet" ng-submit="confirmarEvaluacion()" class="form-horizontal">
                        <div class="box-group" id="accordion">
                            <div class="panel box box-primary" ng-repeat="competencia in competencias" ng-re>
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                            <p>{{competencia.titulo}}</p>                                
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$index}}" class="panel-collapse collapse">
                                    <div class="box-body table-responsive">
                                        <!-- detalles-->
                                        <table class="table table-bordered">

                                            <th>Detalle de Competencia</th>
                                            <th>Autoevaluación</th>
                                            <th>Evaluación</th>


                                            <tr ng-repeat="elemento in autoEvaluaciones[$index]">
                                                <td>{{elemento.descrip}}</td>
                                                
                                                <td>
                                                    <median ng-show="{{elemento.valor != '-' }}">{{elemento.valor}}</median>
                                                    <median ng-show="{{elemento.valor == '-' || elemento.valor == ''}}" class="label bg-red margin">Pendiente</median>
                                                </td>
                                                
                                                
                                                
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-5">
                                                            <input type="number" min="0" max="100" ng-value="{{elemento.valor2}}" class="form-control" name={{competencia.id}} placeholder="0"> 
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
                        <button type="submit" ng-show="{{competencias.length == 0}}" class="btn btn-primary btn-lg pull-right">Guardar Cambios</button>
                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer" >    
                </div>
            </div>
            <!-- /.box-footer-->
        </div>
    </section>
</div>
<!-- /.content -->