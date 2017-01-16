<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>Reporte Individual
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/reporteIndividual">ReporteIndividual</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="controlUsuario" ng-init="init()">
    <!-- Default box -->
    <div class="col-md-3" ng-controller="controlPeriodo" ng-init="init()">
        <div class="box box-primary">
            <div class="box-header with-border ">
                <h3 class="box-title">Periodos</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr ng-repeat="perio in periodos" sglclick="setPeriodo({{perio}})" dblclick="" ng-class="{active:isSelected(perio.id)}">
                        <td> {{perio.nombre}}  <span ng-show="isIdActual(perio.id)" class="label label-success">Actual</span>
                        </td>
                    </tr>
                </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
            </div>
        </div>
        <!-- /.box-footer-->
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Administración de Usuarios</h3>
                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body">
                <table id="usuarios" class="table table-hover table-bordered table-responsive" datatable="ng">
                    <thead>
                        <tr>
                            <th ng-show="false">Id</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Departamento</th>
                            <th>Empresa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="user in users" sglclick="" dblclick="reporte({{user}});">
                            <td ng-show="false"> {{user.id}} </td>
                            <td> {{user.nombre + " " + user.apellido1 + " " + user.apellido2}} </td>
                            <td> 
                                <small ng-show="user.estado == 1" class="label bg-green margin">Activo</small>
                                <small ng-show="user.estado != 1"class="label bg-red margin">Inactivo</small>
                            </td>
                            <td> {{user.departamento}}</td>
                            <td> {{user.empresa}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </div>
</section>
<!-- /.content -->