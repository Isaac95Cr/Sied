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
<section class="content">
    <!-- Default box -->
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border ">
                <h3 class="box-title">Perfiles</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover"> 
                    <tr>
                        <td> Gerencial </td>
                        <td style="text-align:center"><a href="#/" class=""><i class="fa fa-close"></i>  </a> </td>
                    </tr>
                    <tr>
                        <td>Jefatura</td>
                        <td style="text-align:center"><a href="#/" class=""><i class="fa fa-close"></i>  </a> </td>
                    </tr>
                    <tr>
                        <td>Profesional</td>
                        <td style="text-align:center"><a href="#/" class=""><i class="fa fa-close"></i>  </a> </td>
                    </tr>
                    <tr>
                        <td>Tecnico</td>
                        <td style="text-align:center"><a href="#/" class=""><i class="fa fa-close"></i>  </a> </td>
                    </tr>
                    <tr>
                        <td>Operativo</td>
                        <td style="text-align:center"><a href="#/" class=""><i class="fa fa-close"></i>  </a> </td>
                    </tr>
                </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <a class="btn btn-primary btn-lg pull-right" href="#/">Agregar </a>
            </div>
        </div>
        <!-- /.box-footer-->
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Competencias de Perfil X </h3>
                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body table-responsive">
                <div class="box-group" id="accordion">
                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">
                                    #1 Título de la Competencia
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="box-body">
                                <!-- detalles-->
                                <div class="box-group" id="accordio">   
                                    <table class="table table-bordered table-hover table-responsive">
                                        <tbody>
                                            <tr>
                                                <td>Descripción</td>
                                                <td>Peso</td>
                                            </tr>
                                            <tr>
                                                <td>Descripción</td>
                                                <td>Peso</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- ./detalles-->
                            </div>
                        </div>
                    </div>

                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo">
                                    #2 Título de la Competencia
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="box-body">
                                <table class="table table-bordered table-hover table-responsive">
                                        <tbody>
                                            <tr>
                                                <td>Descripción</td>
                                                <td>Peso</td>
                                            </tr>
                                            <tr>
                                                <td>Descripción</td>
                                                <td>Peso</td>
                                            </tr>
                                            <tr>
                                                <td>Descripción</td>
                                                <td>Peso</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <a class="btn btn-primary btn-lg pull-right" href="#/editar_perfil-competencia">Editar </a>
            </div>
        </div>
        <!-- /.box-footer-->
    </div>
</section>
<!-- /.content -->
<script type="text/javascript">
    $("tr").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
    });
</script>
