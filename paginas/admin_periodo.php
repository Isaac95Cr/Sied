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
            <!--
            <form class="form-horizontal">
                <div class="form-group" ng-class="{'has-error': dateForm.daterange2.$invalid}">
                    <label for="daterange2" class="control-label">Picker with min and max date</label>
                    <input date-range-picker id="daterange2" name="daterange2" class="form-control date-picker" type="text"
                           min="'{{limit.minDate| toMoment }}'" max="'{{limit.maxDate| toMoment }}'" ng-model="date"
                           required/>
                </div>
                {{date.startDate| toMoment }}
                {{date.endDate| toMoment}}
                <br>
                {{limit.minDate}}
                {{limit.maxDate}}
                
                <div class="form-group">
                    <label for="daterange3" class="control-label">Picker with custom locale</label>
                    <input date-range-picker id="daterange3" name="daterange3" class="form-control date-picker" type="text"
                           ng-model="date2" options="opts" required/>
                </div>
                <div class="form-group">
                    <label for="daterange4" class="control-label">Clearable picker</label>
                    <input date-range-picker id="daterange4" name="daterange4" class="form-control date-picker" type="text"
                           ng-model="date" clearable="true" required/>
                </div>
                <div class="form-group">
                    <label for="daterange5" class="control-label">Picker with custom format</label>
                    <div class="input-group col-md-6" id="daterange5">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input date-range-picker name="daterange5" class="form-control date-picker" type="text"
                           ng-model="date" options="{locale: {format: 'MM / D / YYYY'}}" required/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-chevron-down"></span></span>
                    </div>
                </div>
                
            </form>
            -->
            <!-- /.box-body -->
            <wizard on-finish=""> 
                <wz-step wz-title="Rango General del Periodo">
                    <h1>This is the first step</h1>
                    <p></p>
                    <form class="form-horizontal">
                        <div class="form-group" ng-class="{'has-error': dateForm.daterange2.$invalid}">
                            <label for="daterange2" class="col-sm-3 control-label">Seleccione el rango del Periodo</label>
                            <div class="col-sm-9">
                                <input date-range-picker id="daterange2" name="daterange2" class="form-control date-picker" type="text"
                                       min="''" max="''" ng-model="model.date1"
                                       required/>
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <input type="submit" class="btn btn-primary pull-right" wz-next value="Continuar" />
                                {{model.date1.startDate| toMoment }}
                                {{model.date1.endDate| toMoment}}
                            </div>
                        </div>
                    </form>
                </wz-step>
                <wz-step wz-title="Rango de ..1">
                    <h1>Continuing</h1>
                    <p>You have continued here!</p>
                    <form class="form-horizontal">
                        <div class="form-group" ng-class="{'has-error': dateForm.daterange2.$invalid}">
                            <label for="daterange2" class="col-sm-3 control-label">Seleccione el rango del Periodo</label>
                            <div class="col-sm-9">
                                <input date-range-picker id="daterange2" name="daterange2" class="form-control date-picker" type="text"
                                       min="time('date1','startDate')" max="time('date1','endDate')" wz-data ng-model="model.date2"
                                       required/>
                            </div>
                            <div class="col-sm-12">
                                <br>
                                {{model.date1.startDate | toMoment }}
                                {{model.date1.endDate | toMoment }}
                                <input type="submit" class="btn btn-primary pull-left" wz-previous value="Atrás" />
                                <input type="submit" class="btn btn-primary pull-right" wz-next value="Continuar" />
                            </div>
                        </div>
                    </form>
                </wz-step>
                <wz-step wz-title="Rango de ..2">
                    <h1>Continuing</h1>
                    <p>You have continued here!</p>
                    <form class="form-horizontal">
                        <div class="form-group" ng-class="{'has-error': dateForm.daterange2.$invalid}">
                            <label for="daterange2" class="col-sm-3 control-label">Seleccione el rango del Periodo</label>
                            <div class="col-sm-9">
                                <input date-range-picker id="daterange2" name="daterange2" class="form-control date-picker" type="text"
                                       min="time('date2','endDate')" max="time('date1','endDate')" ng-model="model.date3"
                                       required/>
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <input type="submit" class="btn btn-primary pull-left" wz-previous value="Atrás" />
                                <input type="submit" class="btn btn-primary pull-right" wz-next value="Continuar" />
                            </div>
                        </div>
                    </form>
                </wz-step>
                <wz-step wz-title="Rango de ..3">
                    <h1>Continuing</h1>
                    <p>You have continued here!</p>
                    <form class="form-horizontal">
                        <div class="form-group" ng-class="{'has-error': dateForm.daterange2.$invalid}">
                            <label for="daterange2" class="col-sm-3 control-label">Seleccione el rango del Periodo</label>
                            <div class="col-sm-9">
                                <input date-range-picker id="daterange2" name="daterange2" class="form-control date-picker" type="text"
                                       min="time('date3','endDate')" max="time('date1','endDate')" ng-model="model.date4"
                                       required/>
                            </div>
                            <div class="col-sm-12">
                                <br>
                                {{model.date3.startDate | toMoment }}
                                {{model.date3.endDate | toMoment }}
                                <input type="submit" class="btn btn-primary pull-left" wz-previous value="Atrás" />
                                <input type="submit" class="btn btn-primary pull-right" wz-next value="Continuar" />
                            </div>
                        </div>
                    </form>
                </wz-step>
                <wz-step wz-title="Crear Periodo">
                    <p>Even more steps!!</p>
                    <div class="col-sm-12">
                        <br>
                        <input type="submit" class="btn btn-primary pull-left" wz-previous value="Atrás" />
                        <input type="submit" class="btn btn-primary pull-right" wz-next value="Finalizar" />
                    </div>
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