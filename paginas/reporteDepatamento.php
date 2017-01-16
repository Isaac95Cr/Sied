<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>Reporte Departamento
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/reporteDepartamento">ReporteDepartamento</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="col-md-4" ng-controller="controlPeriodo" ng-init="init()">
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
    
    <div class="col-md-4" ng-controller="controlEmpresa" ng-init="init()">
        <div class="box box-primary">
            <div class="box-header with-border ">
                <h3 class="box-title">Empresas</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id='tablaEmpresas'>

                    <tr class='clickable-row' ng-repeat="empresa in empresas" sglclick="selectEmpresa({{empresa}})" dblclick="modalModificar({{empresa}});" ng-class="{active:isSelected(empresa.id)}">
                        <td> {{empresa.nombre}} </td>
                    </tr>
                </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
            </div>
        </div>
        <!-- /.box-footer-->
    </div>
    
    <div class="col-md-4" ng-controller="controlDepartamento" ng-init="init()">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Departamentos de Empresa: <b></b></h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr ng-repeat="departamento in departamentos | filter: filtro" sglclick="setDepartamento(departamento)" dblclick="" ng-class="{active:isSelected(departamento.id)}">
                        <td> {{departamento.nombre}}</td>
                    </tr>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <button type="button" class="btn btn-primary btn-lg pull-right" ng-disabled="btn()" ng-click="reporte()">Generar Reporte</button>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->