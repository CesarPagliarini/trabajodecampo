@extends('layouts.content-panel')
@section('page-name')
    Nuevo Usuario
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('users.store')}}"
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
                        <div class="form-group row @if ($errors->has('email')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Email <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control" name="email">
                                <span class="control-label">
                                    <p>{{ $errors->first('email') }}</p>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('password')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Password <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-password" type="password" class="form-control" name="password">
                                <span class="control-label">
                                    <p>{{ $errors->first('password') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('roles')) has-error @endif">
                            <label class="col-sm-2 control-label">Roles<span class="oblig">&nbsp;</span></label>
                            <div class="col-sm-8 offset-2">
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-sm-6 ">
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" name="roles[]" value="{{$role->id}}">
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                        <span class="control-label">
                                    <p>{{ $errors->first('roles') }}</p>
                                </span>
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
