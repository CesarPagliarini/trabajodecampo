@extends('layouts.content-panel')
@section('page-name')
    Editar servicio
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('services.update', [$service])}}"
                          class="form-horizontal offset-1"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" type="text" class="form-control"
                                       value="{{$service->name}}"
                                       name="name">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('description')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Descripcion <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control"
                                       value="{{$service->description}}"
                                       name="description">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('specialties')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Especialidades <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                @if(count($specialties))
                                <select class="specialties_select form-control" name="specialties[]" multiple="multiple">
                                    @foreach($specialties as $specialty)
                                        <option
                                            @if($service->hasSpecialty($specialty->id))
                                                selected
                                            @endif
                                            value="{{$specialty->id}}">{{$specialty->name}}</option>
                                    @endforeach
                                    @else
                                        <a class="btn btn-primary btn-rounded btn-block" href="{{route('specialties.create')}}">
                                            <i class="fa fa-info-circle"></i>
                                            Aun no existen especialidades cargados.
                                        </a>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-3">

                                <div class="i-checks"><label> <input type="radio" value="1" name="state" @if(($service->state)==1) checked="" @endif> <i></i> Activo </label></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="i-checks"><label> <input type="radio" value="0" name="state" @if(($service->state)==0) checked="" @endif > <i></i> Inactivo </label></div>
                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('services.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $.fn.select2.defaults.set('language', 'es');

        $(document).ready(function(){
            $(".specialties_select").select2(
                {width: '100%'}
            );
        })
    </script>
@endsection
