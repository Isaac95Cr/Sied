<section class="content-header">
    <h1>Autoevaluar Metas
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/metas">Metas</a></li>
        <li><a href="#/auto-evaluar_metas">Autoevaluar Metas</a></li>
    </ol>
</section>



<!-- Main content -->
<div ng-controller="controlMeta" ng-init="init()">
    <section class="content">
        <!-- Default box -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Metas</h3>

                    <div class="box-tools pull-right">

                    </div>
                </div>
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <div class="panel box box-primary" ng-repeat="meta in metas" ng-if="meta.evaluable === '1' ">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" data-target="#collapse{{$index}}">
                                        <p>{{meta.titulo}}</p>
                                    </a>
                                </h4>
                            </div>
                            
                            <div id="collapse{{$index}}" class="panel-collapse collapse">
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered" id="tableAutoEv">
                                        <tr>
                                            <td style="font-weight: bold;">Descripción</td>
                                            <td style="font-weight: bold;">Peso</td>
                                            <td style="font-weight: bold;">Nota</td>
                                        </tr>
                                        <tr>
                                            <td> {{meta.descripcion}} </td>
                                            <td> {{meta.peso}} </td>
                                            <td> <input type="number" min="0" max="100" ng-model="auto_Evaluacion" class="form-control" placeholder="0" id={{meta.id}} name={{meta.id}} ></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
                <!-- /.box-body -->
                
                
                <div class="box-footer" >
                    <button type="button" class="btn btn-primary btn-lg pull-right">Guardar cambios</button>
                </div>
                
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->


</div>



<script>

</script>
