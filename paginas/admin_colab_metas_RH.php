
<section class="content-header">
    <h1>Administración de Metas     
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
    </ol>
</section>


<!-- Main content -->
<div ng-controller="controlMetaColabRH" ng-init="init();">
    <section class="content">
        <!-- Default box -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Metas por Departamento</h3>

                    <div class="box-tools pull-right">

                    </div>
                </div>
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <div class="panel box box-primary" ng-repeat="departamento in listadoDepartamentos">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                        <p>{{departamento.nombre}}
                                        <span ng-show="departamento.usuarios != 0" class="label label-danger">{{departamento.usuarios.length}}</span>
                                        </p>
                                    </a>
                                </h4>
                            </div>

                            <div id="collapse{{$index}}" class="panel-collapse collapse">
                                <div>
                                    <table id="example1" class="table table-bordered table-striped" datatable="ng" >
                                        <thead>
                                            <tr>
                                                <th ng-show="false">Id</th>
                                                <th>Nombre</th>
                                                <th>Detalles</th>
                                                <th>Aprobar</th>
                                            </tr>
                                        </thead>

                                        <tr ng-repeat="user in departamento.usuarios">
                                            <td ng-show="false"> {{user.id}} </td>
                                            <td><p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>" > {{user.nombre + " " + user.apellido1 + " " + " " + user.apellido2}} </p></td>
                                            <td><a class="btn btn-primary btn-block" ng-click="pasarId(user.id)" href="#/detalleMetasRH">Detalle</a></td>
                                            <td><a class="btn btn-primary btn-block" ng-click="pasarId(user.id)" href="#/aprobar_metas_RH">Aprobar</a></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer" >    
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
    </section>
    <!-- /.content -->

</div>    

<!--</div>-->



<script>

</script>