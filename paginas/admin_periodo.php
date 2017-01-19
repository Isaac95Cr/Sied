<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>Administración Período
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_periodo">Periodo</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="controlPeriodo" ng-init="init()">

    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border ">
                <h3 class="box-title">Periodos</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr ng-repeat="perio in periodos" sglclick="verPeriodo({{perio}})" dblclick="" ng-class="{active:isSelected(perio.id)}">
                        <td> {{perio.nombre}} <span ng-show="isIdActual(perio.id)" class="label label-success">Actual</td>
                        <td style="text-align:center"><a ng-click="confirmar(perio.id)" class=""><i class="fa fa-close"></i>  </a> </td>
                    </tr>
                </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >    
                <a class="btn btn-primary btn-lg pull-right" ng-show="!addBool  && !setBool" ng-click="agregarPeriodo()">Agregar</a>
            </div>
        </div>
        <!-- /.box-footer-->
    </div>

    <!-- Default box -->
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" ng-show="!setBool && !addBool && isPeriodoActual()">Período Actual</h3>
                <h3 class="box-title" ng-show="!setBool && !addBool && !isPeriodoActual()">Período</h3>
                <h3 class="box-title" ng-show="addBool">Agregar nuevo Período</h3>
                <h3 class="box-title" ng-show="setBool">Modificar Período</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">

                <form class="form-horizontal" name="form" ng-show="!addBool && !setBool">
                    <div class="form-group" ng-class="{
                        'has-error'
                        : form.date1.$invalid}">
                        <label for="daterange2" class="col-sm-4 control-label">Nombre del Período</label>
                        <div class="col-sm-8">
                            <div class="col-sm-8">
                                <input type="text" class="form-control" ng-model="periodo.nombre" required disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{
                        'has-error'
                        : form.date1.$invalid}">
                        <label for="daterange2" class="col-sm-4 control-label">Rango del Período General</label>
                        <div class="col-sm-8">
                            <div class="col-sm-8">
                                <input date-range-picker id="daterange2" name="date1" class="form-control date-picker" type="text"
                                       min="" max="" ng-model="periodo.date1" options="{locale: {format: 'D/ MM / YYYY'}}"
                                       required disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{
                        'has-error'
                        : form.date2.$invalid}">
                        <label for="daterange2" class="col-sm-4 control-label">Rango del ingreso de metas</label>
                        <div class="col-sm-8">
                            <div class="col-sm-8">
                                <input date-range-picker id="daterange2" name="date2" class="form-control date-picker" type="text"
                                       min="time('date1','startDate')" max="time('date1','endDate')" ng-model="periodo.date2" options="{locale:  {format: 'D/ MM / YYYY'}}"
                                       required disabled/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" ng-class="{
                        'has-error': form.date3.$invalid}">
                        <label for="daterange2" class="col-sm-4 control-label">Rango evaluación de metas y competencias </label>
                        <div class="col-sm-8">
                            <div class="col-sm-8">
                                <input date-range-picker id="daterange2" name="date3" class="form-control date-picker" type="text"
                                       min="time('date2','endDate')" max="time('date1','endDate')" ng-model="periodo.date3" options="{locale: {format: 'D / MM / YYYY'}}"
                                       required disabled/>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- /.crear periodo -->
                <div ng-if="addBool || setBool">
                    <wizard on-finish=""> 
                        <wz-step wz-title="Rango General del Periodo">
                            <h1></h1>
                            <p>Definición de fechas para el nuevo periodo</p>
                            <br>
                            <form class="form-horizontal" name="fdate1">
                                <div class="form-group" ng-class="{
                                    'has-error': fdate1.date1.$invalid && !fdate1.date1.$pristine}">
                                    <label for="daterange2" class="col-sm-4 control-label">Seleccione el rango del Período</label>
                                    <div class="col-sm-8">
                                        <div class="col-sm-6">
                                            <input date-range-picker id="daterange2" name="date1" class="form-control date-picker" type="text"
                                                   min="" max="''" ng-model="model.date1" options="{locale: {format: 'D/ MM / YYYY'}}"
                                                   required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <input type="submit" ng-disabled="fdate1.$invalid" class="btn btn-primary pull-right" wz-next value="Continuar" />
                                    </div>
                                </div>
                            </form>
                        </wz-step>
                        <wz-step wz-title="Rango de ingreso de metas">
                            <h1></h1>
                            <p>Establezca el siguiente rango de fechas </p>
                            <br>
                            <form class="form-horizontal" name="fdate2" >
                                <div class="form-group" ng-class="{
                                    'has-error'
                                    : fdate2.date2.$invalid && !fdate2.date2.$pristine}">
                                    <label for="daterange2" class="col-sm-4 control-label">Seleccione el rango del Período</label>
                                    <div class="col-sm-8">
                                        <div class="col-sm-6">
                                            <input date-range-picker id="daterange2" name="date2" class="form-control date-picker" type="text"
                                                   min="time('date1','startDate')" max="time('date1','endDate')"ng-model="model.date2" options="{locale:  {format: 'D/ MM / YYYY'}}"
                                                   required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <input type="submit" class="btn btn-primary pull-left" wz-previous value="Atrás" />
                                        <input type="submit" ng-disabled="fdate2.$invalid" class="btn btn-primary pull-right" wz-next value="Continuar" />
                                    </div>
                                </div>
                            </form>
                        </wz-step>
                        <wz-step wz-title="Rango de calificación de competencias">
                            <h1></h1>
                            <p>Establezca el siguiente rango de fechas</p>
                            <br>
                            <form class="form-horizontal" name="fdate3">
                                <div class="form-group" ng-class="{
                                    'has-error': fdate3.date3.$invalid && !fdate3.date3.$pristine}">
                                    <label for="daterange2" class="col-sm-4 control-label">Seleccione el rango del Período</label>
                                    <div class="col-sm-8">
                                        <div class="col-sm-6">
                                            <input date-range-picker id="daterange2" name="date3" class="form-control date-picker" type="text"
                                                   min="time('date2','endDate')" max="time('date1','endDate')" ng-model="model.date3" options="{locale:  {format: 'D/ MM / YYYY'}}"
                                                   required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <input type="submit" class="btn btn-primary pull-left" wz-previous value="Atrás" />
                                        <input type="submit" ng-disabled="fdate3.$invalid" class="btn btn-primary pull-right" wz-next value="Continuar" />
                                    </div>
                                </div>
                            </form>
                        </wz-step>
                        <wz-step wz-title="Fin">
                            <form ng-show="addBool && !setBool" class="form-horizontal" name="form" ng-submit="agregar()">
                                <div class="form-group" ng-class="{
                                    'has-error': form.date1.$invalid}">
                                    <label for="daterange2" class="col-sm-5 control-label">Nombre del Período</label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" ng-model="model.nombre" required disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" ng-class="{
                                    'has-error'
                                    : form.date1.$invalid}">
                                    <label for="daterange2" class="col-sm-5 control-label">Rango del Período General</label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-9">
                                            <input date-range-picker id="daterange2" name="date1" class="form-control date-picker" type="text"
                                                   min="" max="" ng-model="model.date1" options="{locale:  {format: 'D/ MM / YYYY'}}"
                                                   required disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" ng-class="{
                                    'has-error': form.date2.$invalid}">
                                    <label for="daterange2" class="col-sm-5 control-label">Rango del ingreso de metas</label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-9">
                                            <input date-range-picker id="daterange2" name="date2" class="form-control date-picker" type="text"
                                                   min="time('date1','startDate')" max="time('date1','endDate')" ng-model="model.date2" options="{locale:  {format: 'D/ MM / YYYY'}}"
                                                   required disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" ng-class="{
                                    'has-error': form.date3.$invalid}">
                                    <label for="daterange2" class="col-sm-5 control-label">Rango evaluación de metas y competencias </label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-9">
                                            <input date-range-picker id="daterange2" name="date3" class="form-control date-picker" type="text"
                                                   min="time('date2','endDate')" max="time('date1','endDate')" ng-model="model.date3" options="{locale:  {format: 'D/ MM / YYYY'}}"
                                                   required disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row form-group has-error" style="text-align: center;"> 
                                        <p ng-show="!validar()" class="help-block"> Las fechas no coinciden.</p>
                                        <input ng-show="!validar()" type="button" class="btn btn-primary" wz-reset value="Reiniciar"/>
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <input type="button" class="btn btn-primary pull-left" wz-previous value="Atrás" />
                                        <input type="submit" ng-disabled="form.$invalid || !validar()" class="btn btn-primary pull-right" value="Crear Periodo" />
                                    </div>
                                </div>
                            </form>
                            
                            <form ng-show="setBool && !addBool" class="form-horizontal" name="form" ng-submit="modificar()">
                                <div class="form-group" ng-class="{
                                    'has-error': form.date1.$invalid}">
                                    <label for="daterange2" class="col-sm-5 control-label">Nombre del Período</label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" ng-model="model.nombre" required disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" ng-class="{
                                    'has-error'
                                    : form.date1.$invalid}">
                                    <label for="daterange2" class="col-sm-5 control-label">Rango del Período General</label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-9">
                                            <input date-range-picker id="daterange2" name="date1" class="form-control date-picker" type="text"
                                                   min="" max="" ng-model="model.date1" options="{locale:  {format: 'D/ MM / YYYY'}}"
                                                   required disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" ng-class="{
                                    'has-error': form.date2.$invalid}">
                                    <label for="daterange2" class="col-sm-5 control-label">Rango del ingreso de metas</label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-9">
                                            <input date-range-picker id="daterange2" name="date2" class="form-control date-picker" type="text"
                                                   min="time('date1','startDate')" max="time('date1','endDate')" ng-model="model.date2" options="{locale:  {format: 'D/ MM / YYYY'}}"
                                                   required disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" ng-class="{
                                    'has-error': form.date3.$invalid}">
                                    <label for="daterange2" class="col-sm-5 control-label">Rango evaluación de metas y competencias </label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-9">
                                            <input date-range-picker id="daterange2" name="date3" class="form-control date-picker" type="text"
                                                   min="time('date2','endDate')" max="time('date1','endDate')" ng-model="model.date3" options="{locale:  {format: 'D/ MM / YYYY'}}"
                                                   required disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row form-group has-error" style="text-align: center;"> 
                                        <p ng-show="!validar()" class="help-block"> Las fechas no coinciden.</p>
                                        <input ng-show="!validar()" type="button" class="btn btn-primary" wz-reset value="Reiniciar"/>
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <input type="button" class="btn btn-primary pull-left" wz-previous value="Atrás" />
                                        <button type="submit" ng-disabled="form.$invalid || !validar()" class="btn btn-primary pull-right">Modififar Periodo</button>
                                    </div>
                                </div>
                            </form>
                        </wz-step>
                    </wizard>
                </div>
                <!-- /.crear periodo -->

                <!-- /.box-body -->
            </div>
            <div class="box-footer">
                <a class="btn btn-primary btn-lg pull-right" ng-show="!setBool && !addBool && periodos.length != 0" ng-click="modificarPeriodo()">Modificar</a>
                <a class="btn btn-primary btn-lg pull-left" ng-show="addBool || setBool" ng-click="cancelar()">Cancelar</a>
            </div>
            <!-- /.box-footer-->
        </div>
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->