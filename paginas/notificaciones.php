<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>Notificaciones
        <small>Blank example to the fixed layout</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/perfil">Notificaciones</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline" >
                <!-- timeline time label -->
                <li class="time-label" ng-repeat-start="notificacion in notificaciones">
                    <span class="bg-aqua">
                        {{notificacion.fecha| toDate | date:'dd / MMM / yyyy' }}
                    </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li >
                    <i class="fa fa-plus-circle bg-blue"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{notificacion.fecha| toDate | date:'hh:mm:ss' }}</span>

                        <h3 class="timeline-header">{{notificacion.titulo}}</h3>

                        <div class="timeline-body">
                            {{notificacion.descripcion}}
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs" href="{{notificacion.url}}">Ir a la pagina</a>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <li ng-if="$last" ng-repeat-end>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->