
<section class="content-header">
    <h1>Administración de Metas
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_colaboradores_metas">Colaboradores</a></li>
    </ol>
</section>

<!-- Main content -->
<div ng-controller="usersColaboradoresMetas" ng-init="cargar()">
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Colaboradores</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Detalles</th>
                            <th>Aprobar</th>
                            <th>Evaluar</th>
                        </tr>
                    </thead>

                   <tr ng-repeat="user in listaUsuarios">
                        <td><p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>" > {{user.nombre + " " + user.apellido1 + " " + " " + user.apellido2}} </p></td>
                        <td><a class="btn btn-primary btn-block" href="#/detalleMetasJefe/{{user.id}}">Detalle</a></td>
                        <td><a class="btn btn-primary btn-block" href="#/aprobar_metas/{{user.id}}">Aprobar</a></td>
                        <td><a class="btn btn-primary btn-block" href="#/evaluar_metas/{{user.id}}">Evaluar</a></td>
                    </tr>

<!--                        <tr>
        <td> <p data-toggle="popover" data-trigger="hover" data-html="true" data-content="<b>Jefe: <span class='label label-success'>Aprobado</span> <br> RRHH: <span class='label label-warning'>Pendiente</span></b>">Juan</p> </td>
        <td><a class="btn btn-primary btn-block" href="#/admin_metas">Detalle</a></td>
        <td><a class="btn btn-primary btn-block" href="#/aprobar_metas">Aprobar</a></td>
        <td><a class="btn btn-primary btn-block" href="#/evaluar_metas">Evaluar</a></td>
    </tr>-->
                </table>
            </div>
        </div>
</div>
<!-- /.box-body -->
<div class="box-footer">
</div>
<!-- /.box-footer-->
</div>
<!-- /.box -->

</section>
<!-- /.content -->

<script>
    //Initialize Select2 Elements
    $("#example1").DataTable();

    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
        });
    });
</script>
