@extends('layouts.content-panel')
@section('page-name')
    Nuevo dato a editar
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('roles.store')}}"
                        class="form-horizontal offset-1"
                        method="post">
                        @csrf
                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('description')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Descripción <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control" name="description">
                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('roles.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
