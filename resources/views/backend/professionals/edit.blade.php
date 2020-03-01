@extends('layouts.content-panel')
@section('page-name')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a>Editar Profesional</a>
        </li>
        <li class="breadcrumb-item">
            <a style="font-size: 16px">{{$professional->fullname}}</a>
        </li>
    </ol>
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li><a class="nav-link" data-toggle="tab" href="#general"><i class="fa fa-user"></i> Datos generales</a></li>
            @if(Auth::user()->hasRole('Administrador'))
                <li><a class="nav-link " data-toggle="tab" href="#specialties"><i class="fa fa-wrench"></i> Especialidades</a></li>
            @endif
            <li><a class="nav-link active" data-toggle="tab" id="schedule_tab_listener" href="#schedules"><i class="fa fa-briefcase"></i> Horarios</a></li>
            <li><a class="nav-link  " data-toggle="tab" id="setting_tab_listener" href="#settings"><i class="fa fa-cog"></i> Configuracion</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane ">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('professionals.update',$professional)}}"
                          class="form-horizontal offset-1"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row  @if ($errors->has('id')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-id">Código profesional </label>
                            <div class="col-sm-8">
                                <input id="input-id" value="{{$professional->id}}" type="text" class="form-control" name="id">
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$professional->name}}" type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('last_name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Apellido <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-last_name" value="{{$professional->last_name}}" type="text" class="form-control" name="last_name">
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('document')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-document">Document <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-document"  value="{{$professional->document}}" type="text" class="form-control" name="document">
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('date_of_birthday')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Fecha de nacimiento</label>
                            <div class="input-group date col-sm-8">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" value="{{$professional->birthDay}}" class="form-control" name="date_of_birthday" id="dateProfessionalBirth">
                            </div>
                        </div>



                        <div class="form-group row  @if ($errors->has('cuit_cuil')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-cuit_cuil">Cuit / Cuil <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-cuit_cuil" value="{{$professional->cuit_cuil}}" type="text" class="form-control" name="cuit_cuil">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('email')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Email <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" value="{{$professional->email}}"  type="text" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('password')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-password">Password <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-password"  type="password" placeholder="******" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('address')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-address">Dirección <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-address"  value="{{$professional->address}}" type="text" class="form-control" name="address">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('cel_phone')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Teléfono <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-cel_phone" value="{{$professional->cel_phone}}" type="text" class="form-control" name="cel_phone">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('city')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Ciudad <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-city"  value="{{$professional->city}}" type="text" class="form-control" name="city">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('region')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-region">Provincia <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-region" value="{{$professional->region}}" type="text" class="form-control" name="region">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('zip_code')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Código postal <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-zip_code" type="text" value="{{$professional->zip_code}}" class="form-control" name="zip_code">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('country')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-country">Pais <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-country" type="text" value="{{$professional->country}}" class="form-control" name="country">
                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('professionals.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('backend.partials.tabs.professional.schedules-tab')
            @include('backend.partials.tabs.professional.settings-tab')
            @if(Auth::user()->hasRole('Administrador'))
                @include('backend.partials.tabs.professional.specialties-tab')

            @endif
        </div>
    </div>
    @include('backend.modals.shure-delete-professional-setting')
@endsection


@section('custom-scripts')
    <script>
        const professional = JSON.parse('@json($professional->only('id', 'name'))');
        const updateSpecialtyProfessionalUrl = "{{route('professionals.update-specialties')}}"
        const professionalSpecialtiesUrl = "{{route('professional-settings.get.specialty.list')}}"
        const specialtyServicesUrl = "{{route('professionals-settings.specialty.services')}}"
        const attentionCentersUrl = "{{route('professionals-settings.get.attention.places.list')}}"
        const getCurrenciesUrl = "{{route('professionals-settings.get.currencies.list')}}"
        const addSettingsRoute = "{{route('professionals-settings.add-settings')}}"
        const removeRoute = "{{route('professionals-settings.remove-settings')}}"
        const professionalConfigs = "{{route('professionals-settings.configs')}}"


        const scheduleListUrl = "{{route('professional-schedules.get.schedule.list')}}"
        const scheduleAddUrl = "{{route('professionals-schedules.add.schedule')}}"
        const scheduleRemoveUrl = "{{route('professionals-schedules.remove.schedule')}}"
    </script>
    <script src="{{asset('js/professional/settings-tab.js')}}"></script>
    <script src="{{asset('js/professional/specialty-tab.js')}}"></script>
    <script src="{{asset('js/professional/schedules-tab.js')}}"></script>


@endsection
@section('custom-styles')
    <style>
        .bg-danger{
            padding:2px;
            border-radius: 5px;
        }
    </style>
@endsection



