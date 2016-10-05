<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Administracion de Perfiles de Competencia
        <small>Blank example to the fixed layout</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_perfil-competencia">Perfil de Competencias</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content"ng-controller="controlPerfilCompetencia" ng-init="init()">
    <!-- Default box -->
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border ">
                <h3 class="box-title">Perfiles</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body table-responsive no-padding" >
                <table class="table table-hover"> 
                    <tr ng-repeat="perfil in perfiles" ng-click="selectPerfil(perfil)">
                        <td> {{perfil.nombre}} </td>
                        <td style="text-align:center"><a ng-click="confirmar(perfil.id)"><i class="fa fa-close"></i>  </a> </td>
                    </tr>
                </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalPerfil">Agregar </a>
            </div>
        </div>
        <!-- /.box-footer-->
        <!-- /.modal -->
        <div class="modal" id="modalPerfil">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Agregar Perfil de Competencia</h4>
                    </div>
                    <form name="perfilForm" class="form-horizontal" ng-submit="agregar()" novalidate> 
                        <div class="modal-body">

                            <div class="form-group" ng-class="{ 'has-error' : perfilForm.perfilNombre.$invalid && !perfilForm.perfilNombre.$pristine }">
                                <label for="perfil" class="col-sm-2 control-label">Perfil</label>
                                <div class="col-sm-10">
                                    <input class="form-control" placeholder="Nombre" id="perfil" name="perfilNombre" ng-model="perfilNombre" required>
                                    <p ng-show="perfilForm.perfilNombre.$invalid && !perfilForm.perfilNombre.$pristine" class="help-block">Nombre del perfil</p>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-primary" ng-disabled="perfilForm.$invalid"  id="add-perfil">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Competencias de Perfil {{perfil.nombre}} </h3>
                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body table-responsive">
                <div class="box-group" id="accordion">
                    <div class="panel box box-primary" ng-repeat="competencia in perfil.competencias">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                    #{{$index + 1}} {{competencia.titulo}}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{$index}}" class="panel-collapse collapse" ng-class='{in:$first}'>
                            <div class="box-body">
                                <b>Descripción:</b>
                                <p>{{competencia.descripcion}}</p>
                                <div class="box-group">   
                                    <table class="table table-bordered table-hover table-responsive">
                                        <thead>
                                        <th>Detalles de la competencia</th>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="detalle in competencia.detalles">
                                                <td>{{detalle.descripcion}}</td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                                <!-- ./detalles-->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <a class="btn btn-primary btn-lg pull-right" href="#/editar_perfil-competencia/{{perfil.id}}">Editar </a>
            </div>
        </div>

    </div> 

    <!-- /.box-footer-->
</section>
<!-- /.content -->
<script type="text/javascript">
    $("tr").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
    });
    $('#add-perfil').click(function () {
        $('#modalPerfil').modal('toggle');
        return true;
    });
</script>
