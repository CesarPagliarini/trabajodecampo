@extends('layouts.content-panel')
@section('page-name')
    Editar Formulario
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('permissions.update', $permission)}}"
                          class="form-horizontal offset-1"
                          method="POST">
                        @csrf
                       @method('PUT')
                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" type="text" class="form-control"
                                       value="{{$permission->name}}"
                                       name="name">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('description')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Descripción <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control"
                                       value="{{$permission->description}}"
                                       name="description">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('action')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Acción <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control"
                                       value="{{$permission->action}}"
                                       name="action">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('icon')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Ícono <span class="oblig">*</span></label>

                            <div class="col-sm-3">
                                <i class="{{$permission->icon}} fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-sm-4">
                                <input id="input-email" type="text" class="form-control"
                                       value="{{$permission->icon}}"
                                       name="icon">
                            </div>

                            <div class="col-sm-2">
                                <button class="btn btn-primary dim"
                                        onclick="window.open('https://fontawesome.com/v4.7.0/icons/')"
                                        type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('forms.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
