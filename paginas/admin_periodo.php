<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>Administración Periodo
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/"><i class="fa  fa-building-o"></i> Índice</a></li>
        <li><a href="#/admin_periodo">Periodo</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="controlPeriodo" ng-init="init()">
    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        <div class="box-body">
            <!-- /.box-body -->
            <wizard on-finish=""> 
                <wz-step wz-title="Rango General del Periodo">
                    <h1>This is the first step</h1>
                    <p></p>
                    <br>
                    <form class="form-horizontal" name="fdate1">
                        <div class="form-group" ng-class="{'has-error': fdate1.date1.$invalid && !fdate1.date1.$pristine}">
                            <label for="daterange2" class="col-sm-4 control-label">Seleccione el rango del Periodo</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <input date-range-picker id="daterange2" name="date1" class="form-control date-picker" type="text"
                                           min="''" max="''" ng-model="model.date1" options="{locale: {format: 'MM / D / YYYY'}}"
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
                    <h1>Continuing</h1>
                    <p>You have continued here!</p>
                    <br>
                    <form class="form-horizontal" name="fdate2">
                        <div class="form-group" ng-class="{'has-error': fdate2.date2.$invalid && !fdate2.date2.$pristine}">
                            <label for="daterange2" class="col-sm-4 control-label">Seleccione el rango del Periodo</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <input date-range-picker id="daterange2" name="date2" class="form-control date-picker" type="text"
                                           min="time('date1','startDate')" max="time('date1','endDate')"ng-model="model.date2" options="{locale: {format: 'MM / D / YYYY'}}"
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
                    <h1>Continuing</h1>
                    <p>You have continued here!</p>
                    <br>
                    <form class="form-horizontal" name="fdate3">
                        <div class="form-group" ng-class="{'has-error': fdate3.date3.$invalid && !fdate3.date3.$pristine}">
                            <label for="daterange2" class="col-sm-4 control-label">Seleccione el rango del Periodo</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <input date-range-picker id="daterange2" name="date3" class="form-control date-picker" type="text"
                                           min="time('date2','endDate')" max="time('date1','endDate')" ng-model="model.date3" options="{locale: {format: 'MM / D / YYYY'}}"
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
                <wz-step wz-title="Rango de calificación de metas">
                    <h1>Continuing</h1>
                    <p>You have continued here!</p>
                    <br>
                    <form class="form-horizontal" name="fdate4">
                        <div class="form-group" ng-class="{'has-error': fdate4.date4.$invalid && !fdate4.date4.$pristine}">
                            <label for="daterange2" class="col-sm-4 control-label">Seleccione el rango del Periodo</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <input date-range-picker id="daterange2" name="date4" class="form-control date-picker" type="text"
                                           min="time('date3','endDate')" max="time('date1','endDate')" ng-model="model.date4" options="{locale: {format: 'MM / D / YYYY'}}"
                                           required/>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <input type="submit" class="btn btn-primary pull-left" wz-previous value="Atrás" />
                                <input type="submit" ng-disabled="fdate4.$invalid" class="btn btn-primary pull-right" wz-next value="Continuar" />
                            </div>
                        </div>
                    </form>
                </wz-step>
                <wz-step wz-title="Crear Periodo">
                    <form class="form-horizontal" name="form">
                        <div class="form-group" ng-class="{'has-error': form.date1.$invalid}">
                            <label for="daterange2" class="col-sm-4 control-label">Nombre del Periodo</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" ng-model="model.nombre" required disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{'has-error': form.date1.$invalid}">
                            <label for="daterange2" class="col-sm-4 control-label">Rango del Periodo General</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <input date-range-picker id="daterange2" name="date1" class="form-control date-picker" type="text"
                                           min="" max="" ng-model="model.date1" options="{locale: {format: 'MM / D / YYYY'}}"
                                           required disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{'has-error': form.date2.$invalid}">
                            <label for="daterange2" class="col-sm-4 control-label">Rango del ingreso de metas</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <input date-range-picker id="daterange2" name="date2" class="form-control date-picker" type="text"
                                           min="time('date1','startDate')" max="time('date1','endDate')" ng-model="model.date2" options="{locale: {format: 'MM / D / YYYY'}}"
                                           required disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{'has-error': form.date3.$invalid}">
                            <label for="daterange2" class="col-sm-4 control-label">Rango calificación de competencias</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <input date-range-picker id="daterange2" name="date3" class="form-control date-picker" type="text"
                                           min="time('date2','endDate')" max="time('date1','endDate')" ng-model="model.date3" options="{locale: {format: 'MM / D / YYYY'}}"
                                           required disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{'has-error': form.date4.$invalid}">
                            <label for="daterange2" class="col-sm-4 control-label">Rango calificación de metas</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <input date-range-picker id="daterange2" name="date4" class="form-control date-picker" type="text"
                                           min="time('date3','endDate')" max="time('date1','endDate')" ng-model="model.date4" options="{locale: {format: 'MM / D / YYYY'}}"
                                           required disabled/>
                                </div>
                            </div>
                            <div class="row form-group has-error" style="text-align: center;"> 
                                <br>
                                <br>
                                <p ng-show="!validar()" class="help-block"> Las fechas no coinsiden.</p>
                                <input ng-show="!validar()" type="submit" class="btn btn-primary" wz-reset value="Reiniciar"/>
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <input type="submit" class="btn btn-primary pull-left" wz-previous value="Atrás" />
                                <input type="submit" ng-disabled="form.$invalid || !validar()" class="btn btn-primary pull-right" wz-next value="Crear Periodo" />
                            </div>
                        </div>
                    </form>
                </wz-step>
            </wizard>
        </div>
        <div class="box-footer">

        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->