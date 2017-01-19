
<section class="content-header">
    <h1>Administración de Metas     
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_colaboradores_metas">Colaboradores</a></li>
    </ol>
</section>


<!-- Main content -->
<div ng-controller="usersColaboradoresMetas" ng-init="init();">
    <section class="content">
        <!-- Default box -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Colaboradores por Departamento</h3>

                    <div class="box-tools pull-right">

                    </div>
                </div>
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <div class="panel box box-primary" ng-repeat="departamento in listaUsuarios">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                        <p>{{departamento.nombre}}</p>
                                    </a>
                                </h4>
                            </div>

                            <div id="collapse{{$index}}" class="panel-collapse collapse">
                                <div>
                                    <table id="example1" class="table table-bordered table-striped" datatable="ng" style="border-top: 3px solid #3c8dbc;">
                                        <thead>
                                            <tr>
                                                <th ng-show="false">Id</th>
                                                <th style="text-align: center;">Nombre</th>
                                                <th style="text-align: center;">Detalles</th>
                                                <th style="text-align: center;">Aprobar</th>
                                                <th style="text-align: center;">Evaluar</th>
                                            </tr>
                                        </thead>

                                        <tr ng-show="{{user.id !== userOnline}}" ng-repeat="user in departamento.usuarios">
                                            <td ng-show="false"> {{user.id}} </td>
                                            <td><p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>" > {{user.nombre + " " + user.apellido1 + " " + " " + user.apellido2}} </p></td>
                                            <td><a class="btn btn-primary btn-block" ng-click="pasarId(user.id)" href="#/detalleMetasJefe">Detalle</a></td>
                                            <td><a class="btn btn-primary btn-block" ng-click="pasarId(user.id)" href="#/aprobar_metas">Aprobar</a></td>
                                            <td><a class="btn btn-primary btn-block" ng-click="pasarId(user.id)" href="#/evaluar_metas">Evaluar</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <p style="font-size: 90%" ng-show="!tiene_Metas" class="label bg-red margin">No posee departamentos a cargo</p>
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