@extends('layouts.content-panel')
@section('page-name')
    Editar Usuario
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('users.update', ['user'=> $user])}}"
                          class="form-horizontal offset-1"
                          method="POST">
                        @csrf
                        <div class="form-group row  @if ($errors->has('nombre')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" type="text" class="form-control"
                                       value="{{$user->name}}"
                                       name="name">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('email')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Email <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control"
                                       value="{{$user->email}}"
                                       name="email">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('password')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Password <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-password" type="password" class="form-control"
                                        placeholder="******"
                                       name="password">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('roles')) has-error @endif">
                            <label class="col-sm-2 control-label">Roles<span class="oblig">&nbsp;</span></label>
                            <div class="col-sm-8 offset-2">
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-sm-6 ">
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox"
                                                       @if($user->hasRole($role))
                                                           checked
                                                       @endif
                                                       name="roles[]"
                                                       value="{{$role->id}}">
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('users.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
