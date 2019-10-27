@extends('layouts.content-panel')
@section('page-name')
    Gestionar rol
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('roles.update', $role)}}"
                          class="form-horizontal offset-1"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row ">

                            <div class="col-md-12 ">
                                <div class="col-md-2 offset-2 float-left">Visualizar</div>
                                <div class="col-md-2 float-left">Crear</div>
                                <div class="col-md-2 float-left">Eliminar</div>
                                <div class="col-md-2 float-left">Actualizar</div>
                            </div>
                            @foreach($forms->unique() as $form)

                            <div class="col-md-12">
                            <label class="col-sm-2 float-left control-label" for="input-name">{{$form->name}} </label>
                                @foreach($role->permissions->unique() as $permission)
                                    <div class="col-md-2 float-left">
                                        <label class="checkbox-inline i-checks">
                                            <input type="checkbox"
                                                   name="roles[]"
                                                   value="{{$permission->id}}">

                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @endforeach
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
