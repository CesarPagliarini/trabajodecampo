@extends('layouts.content-panel')
@section('page-name')
    Nuevo servicio
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('services.store')}}"
                        class="form-horizontal offset-1"
                        method="post">
                        @csrf
                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" type="text" class="form-control" name="name">
                                <span class="control-label">
                                    <p>{{ $errors->first('name') }}</p>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('description')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Descripción <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control" name="description">
                                <span class="control-label">
                                    <p>{{ $errors->first('description') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('specialties')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Especialidades <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                    <select class="specialties_select form-control" name="specialties[]" multiple="multiple">
                                        @forelse($specialties as $specialty)
                                            <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                                        @empty
                                            <option value="" selected="true" disabled="true">
                                                Aun no existen especialidades cargadas.
                                            </option>
                                        @endforelse
                                    </select>
                                <span class="control-label">
                                    <p>{{ $errors->first('specialties') }}</p>
                                </span>
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
