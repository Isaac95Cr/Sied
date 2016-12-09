<section class="content-header">
    <h1>Autoevaluar Metas
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/metas">Metas Autoevaluables</a></li>
        <li><a href="#/auto-evaluar_metas">Autoevaluar Metas</a></li>
    </ol>
</section>



<!-- Main content -->
<div ng-controller="controlAutoEvMetas" ng-init="init()">
    <section class="content">
        <!-- Default box -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Metas Autoevaluables</h3>

                    <div class="box-tools pull-right">

                    </div>
                </div>
                <div class="box-body">
                    <form name="formAutoEv" ng-submit="confirmarAutoEv()" class="form-horizontal">
                        <div class="box-group" id="accordion">
                            <div class="panel box box-primary" ng-repeat="meta in metas" ng-if="meta.evaluable === '1'">
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
                                                <td style="font-weight: bold;">Autoevaluación</td>
                                            </tr>
                                            <tr>
                                                <td> {{meta.descripcion}} </td>
                                                <td> {{meta.peso}} </td>
                                                <td>
                                                  <div class="form-group" >
                                                      <div class="col-sm-5">
                                                        <input type="number" min="0" max="100"  class="form-control"  placeholder="0"  id={{meta.id}} name={{meta.id}}  ng-value={{meta.auto_evaluacion}}>
                                                      </div>
                                                  </div>
                                                </td>
                                         </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                        <div class="box-footer" >
                            <button type="submit"  ng-show="tiene_Metas" class="btn btn-primary btn-lg pull-right">Guardar cambios</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
                
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
    
    
    

</div>



<script>

</script>
