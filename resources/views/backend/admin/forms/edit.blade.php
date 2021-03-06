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
                    <form action="{{route('forms.update', $form)}}"
                          class="form-horizontal offset-1"
                          method="POST">
                        @csrf
                       @method('PUT')
                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" type="text" class="form-control"
                                       value="{{$form->name}}"
                                       name="name">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('key')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Clave <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control"
                                       value="{{$form->key}}"
                                       name="key">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('target')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Target / Ruta / Url <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control"
                                       value="{{$form->target}}"
                                       name="target">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('module_id')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Mòdulo <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control m-b" name="module_id">
                                    <option value="Null">Menu Lateral</option>
                                    @foreach($modules as $module)
                                        <option
                                        @if($form->module_id == $module->id)
                                            selected
                                        @endif
                                            name="module_id"
                                            value="{{$module->id}}"
                                        >
                                            {{$module->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-3">

                                <div class="i-checks"><label> <input type="radio" value="1" name="state" @if(($form->state)==1) checked="" @endif> <i></i> Activo </label></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="i-checks"><label> <input type="radio" value="0" name="state" @if(($form->state)==0) checked="" @endif > <i></i> Inactivo </label></div>
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('order')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Órden<span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control m-b" name="order">

                                    @for($i = 1; $i <= $limit; $i++)
                                        <option
                                            name="order"
                                            value="{{$i}}"
                                        >
                                            {{$i}}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('icon')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Ícono <span class="oblig">*</span></label>

                            <div class="col-sm-3">
                                <i class="{{$form->icon}} fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-sm-4">
                                <input id="input-email" type="text" class="form-control"
                                       value="{{$form->icon}}"
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
