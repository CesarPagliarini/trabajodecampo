<div id="settings" class="tab-pane active show">
    <div class="panel-body" style="padding-top:25px">
        <div class="ibox-content" id="professional-settings-wrapper">
            <div class="sk-spinner sk-spinner-wave">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-primary btn-rounded btn-block add-new-config" href="#">
                        <i class="fa fa-plus" id="icon-add-new-config"></i> Agregar
                    </a>
                </div>
            </div>


            <div class="container-fluid mt-5 " id="new-config-container">
                <div class="row hidden" id="settings-alert-span" >
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            Parece que el formulario tiene errores <a class="alert-link" href="#">Revisalos!</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <p> <b>Destacada </b></p>
                            </div>
                            <div class="col-md-1">
                                <input type="checkbox" class="js-switch settings_is_highlighted" checked />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <p> <b>Actividad temporal </b></p>
                            </div>
                            <div class="col-md-8">
                                <input type="checkbox" class="js-switch settings_is_temporal" checked />
                            </div>
                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-form-label">Especialidad</label>
                        </div>
                        <div class="col-md-8">
                            <select class="settings_specialty_select form-control"
                                    id="settings_specialty_select">
                                <option value="">Selecciona una especialidad</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group ">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-form-label">Servicio</label>
                        </div>
                        <div class="col-md-8">
                            <select class="settings_service_select form-control"
                                    id="settings_service_select">
                                <option value="">Selecciona un servicio</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-form-label">Centro de atencion</label>
                        </div>
                        <div class="col-md-8">
                            <select class="settings_attentionPlace_select form-control"
                                    id="settings_attentionPlace_select">
                                <option value="">Selecciona un lugar de atencion</option>
                            </select>
                        </div>
                    </div>
                </div>
                                <div class="col-md-6 form-group">

                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-form-label">Tiempo estimado</label>
                        </div>
                        <div class="col-md-8">
                            <select class="settings_time_unit_input form-control"
                                    id="settings_time_unit_input">
                                <option value="">Selecciona un tiempo estimado</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-form-label">Moneda</label>
                        </div>
                        <div class="col-md-8">
                            <select class="settings_currency_select form-control"
                                    id="settings_currency_select">
                                <option value="">Selecciona una moneda</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-form-label" id="settings_amount_input_label">Costo promedio</label>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group-prepend">
                                <span class="input-group-addon">$</span>
                                <input type="number" id="settings_amount_input" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="row">
                        <div class="col-md-4 ">
                            <label class="col-form-label">Trabaja feriados y domingos</label>
                        </div>
                        <div class="col-md-8 ">
                            <div class="row ">
                                <div class="col-md-4 ">
                                    <div class="i-checks">
                                        <label >
                                            <input type="radio" value="1" name="work_holiday" class="work_holiday"><i></i> si
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="0" class="work_holiday" name="work_holiday" checked="true"><i></i> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-form-label">Muestra precio en web</label>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="1" name="show_amount" class="show_amount"><i></i> si
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="0" class="show_amount" name="show_amount" checked="true"><i></i> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-md-6 offset-9 ">
                    <a class="btn btn-white" id="cancel_settings" >Cancelar</a>
                    <button class="btn btn-primary" id="save_settings">Guardar</button>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
