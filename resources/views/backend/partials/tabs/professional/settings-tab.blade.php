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
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
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
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="col-form-label">Servicio</label>
                        </div>
                        <div class="col-md-8">
                            <select class="settings_service_select form-control"
                                    id="settings_service_select">
                            </select>
                        </div>
                    </div>
                </div>
            </div>


















            @if(count($professional->settings))
            <input type="text" class="form-control
                searchform col-md-3 pull-right"
                               id="filter" placeholder="Buscar...">

            <table class="footable table table-stripped"
                   data-page-size="8" data-filter=#filter >
                <thead>
                <tr>
                    <th>Especialidad</th>
                    <th>Servicios</th>
                </tr>
                </thead>
                <tbody>
                @foreach($professional->settings as $setting)
                    <tr>
                        <td>
                            <a class="accion">
                                <select name="specialty_id"
                                        class="settings_specialty form-control select2-hidden-accessible"
                                        id="settings_specialty_{{$setting->id}}"
                                        tabindex="-1" aria-hidden="true">
                                    @foreach($professional->specialties as $specialty)
                                        <option
                                            @if($professional->hasSpecialty($specialty->id))
                                                selected
                                            @endif
                                            value="{{$specialty->id}}">{{$specialty->name}}</option>
                                    @endforeach
                                </select>
                            </a>
                        </td>
                        <td>
                            <a class="accion">

                            </a>
                        </td>
                        <td>
                            <a class="accion">

                            </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <ul class="pagination pull-right"></ul>
                    </td>
                </tr>
                </tfoot>
            </table>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-primary btn-rounded btn-block" href="#"><i class="fa fa-info-circle"></i> Block rounded with icon button</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
