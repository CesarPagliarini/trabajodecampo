<div id="schedules" class="tab-pane">
    <div class="panel-body" style="padding-top:25px">

        <div class="ibox">

            <a class="btn btn-danger btn-rounded btn-block hidden"
               id="alert_no_config" href="#">
                <i class="fa fa-plus"></i> Aun no tienes configuraciones realizadas
            </a>

            <a class="btn btn-primary btn-rounded btn-block"
               id="add_schedule_button" href="#">
                <i id="schedule_button_icon" class="fa fa-plus"></i> Agregar agenda
            </a>

            <div class="ibox-content " id="professional-schedules-wrapper">
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
                <div class="col-lg-12 hidden" id="schedlue_form_wrapper">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Selecciona los dias y horarios de atencion
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="schedules_attention_place_select form-control"
                                                    id="schedules_attention_place_select">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <span class="help-line has-error ml-3 hidden  bg-danger " id="attention_place_error">Este campo es requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="schedules_specialty_select form-control"
                                                    id="schedules_specialty_select" multiple="multiple">
                                                <option value="" selected>Seleccione un centro primero</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <span class="help-line has-error ml-3 hidden  bg-danger " id="specialty_error">Este campo es requerido</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="form-group" id="schedule_range">
                                    <label class="font-normal">Selecciona un rango de fechas</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="form-control-sm form-control" id="date_from" name="start">
                                        <span class="input-group-addon">Hasta</span>
                                        <input type="text" class="form-control-sm form-control" id="date_to" name="end">
                                    </div>
                                    <div class="row mt-2">
                                        <span class="help-line has-error ml-3 hidden  bg-danger " id="date_interval_error">Este campo es requerido</span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-normal">Selecciona los dias</label>
                                    <select class="schedule_day_select form-control"
                                            id="schedule_day_select" multiple="multiple">
                                        <option value="6">Domingos</option>
                                        <option value="0">Lunes</option>
                                        <option value="1">Martes</option>
                                        <option value="2">Miercoles</option>
                                        <option value="3">Jueves</option>
                                        <option value="4">Viernes</option>
                                        <option value="5">Sabados</option>
                                    </select>
                                    <div class="row mt-2">
                                        <span class="help-line has-error ml-3 hidden  bg-danger " id="schedule_days_error">Este campo es requerido</span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-normal">Horario mañana</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="input-group clockpicker"  data-autoclose="true">
                                                <input type="text" class="form-control" data-error="morning" data-child="morning_to" id="morning_from" value="Apertura" >
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="mt-2">Hasta</span>
                                        <div class="col-md-5">
                                            <div class="input-group clockpicker"  data-autoclose="true">
                                                <input type="text" class="form-control" data-error="morning" data-parent="morning_from" id="morning_to" value="Cierre" >
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11 text-center mt-2">
                                            <span class="help-line has-error" id="error-morning"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="font-normal">Horario tarde</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="input-group clockpicker"  data-autoclose="true">
                                                <input type="text" class="form-control" data-error="afternoon" data-child="afternoon_to" id="afternoon_from" value="Apertura" >
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="mt-2">Hasta</span>
                                        <div class="col-md-5">
                                            <div class="input-group clockpicker"  data-autoclose="true">
                                                <input type="text" class="form-control" data-error="afternoon" data-parent="afternoon_from" id="afternoon_to" value="Cierre" >
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11 text-center mt-2">
                                            <span class="help-line has-error" id="error-afternoon"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="font-normal">Horario corrido</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="input-group clockpicker"  data-autoclose="true">
                                                <input type="text" class="form-control"data-error="full" data-child="full_time_to" id="full_time_from" value="Apertura" >
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="mt-2">Hasta</span>
                                        <div class="col-md-5">
                                            <div class="input-group clockpicker"  data-autoclose="true">
                                                <input type="text" class="form-control" data-error="full" data-parent="full_time_from" id="full_time_to" value="Cierre" >
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11 text-center mt-2">
                                            <span class="help-line has-error" id="error-full"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <span class="help-line has-error ml-3  bg-danger hidden " id="time_error">Debes seleccionar algun horario</span>
                            </div>

                        </div>

                        <div class="panel-footer">
                            <div class="row mt-3">
                                <div class="col-md-6 offset-9 ">
                                    <a class="btn btn-white" id="cancel_schedules" >Cancelar</a>
                                    <button class="btn btn-primary" id="save_schedules">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @forelse($center_grouped_schedules as $key => $center)
            <div class="panel-group mt-2" id="accordion{{$key}}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion{{$key}}" href="#collapseOne{{$key}}" class="collapsed" aria-expanded="false">
                            {{ucfirst($center->first()->attention_place)}}
                        </a>
                    </h5>
                </div>
                <div id="collapseOne{{$key}}" class="panel-collapse in collapse" style="">
                    <div class="panel-body">
                        <div class="row">
                            @forelse($center as $schedule)
                            <div class="col-lg-6">
                                <div class="widget bg-primary p-xl">
                                    <h2>
                                        {{$schedule->specialty}}
                                    </h2>
                                    <ul class="list-unstyled m-t-md">
                                        <li>
                                            <span class="fa fa-calendar m-r-xs"></span>
                                            <label>Fecha:</label>
                                            <p><b>Desde el: </b>{{$schedule->from}} <b>Hasta: </b>{{$schedule->to}}</p>
                                        </li>
                                        <li>
                                            <span class="fa fa-clock-o m-r-xs"></span>
                                            <label>Horarios:</label>
                                            @if($schedule->morning_schedule != null)
                                                <p><b>Por la mañana: </b> {{$schedule->morning_schedule}}</p>
                                            @endif
                                            @if($schedule->afternoon_schedule != null)
                                                <p><b>Por la tarde: </b> {{$schedule->afternoon_schedule}}</p>
                                            @endif
                                            @if($schedule->run_schedule != null)
                                                <p><b>Corrido: </b> {{$schedule->run_schedule}}</p>
                                            @endif
                                        </li>
                                        <li>
                                            <span class="fa fa-phone m-r-xs"></span>
                                            <label>Contact:</label>
                                            (+121) 678 3462
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
</div>
