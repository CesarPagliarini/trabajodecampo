@extends('layouts.content-panel')
@section('page-name')
    Editar cliente
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('clients.update',$client)}}"
                          class="form-horizontal offset-1"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$client->name}}" type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('last_name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Apellido <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-last_name" value="{{$client->last_name}}" type="text" class="form-control" name="last_name">
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('document')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Document <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-document"  value="{{$client->document}}" type="text" class="form-control" name="document">
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('date_of_birthday')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Fecha de nacimiento</label>
                            <div class="input-group date col-sm-8">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" value="{{$client->date_of_birthday}}" class="form-control" name="date_of_birthday" id="dateClientBirth">
                            </div>
                        </div>



                        <div class="form-group row  @if ($errors->has('cuit_cuil')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Cuit / Cuil <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$client->cuit_cuil}}" type="text" class="form-control" name="cuit_cuil">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('email')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Email <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" value="{{$client->email}}"  type="text" class="form-control" name="email">
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
                                <input id="input-address"  value="{{$client->address}}" type="text" class="form-control" name="address">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('cel_phone')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Teléfono <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-cel_phone" value="{{$client->cel_phone}}" type="text" class="form-control" name="cel_phone">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('city')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Ciudad <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-city"  value="{{$client->city}}" type="text" class="form-control" name="city">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('region')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-region">Provincia <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-region" value="{{$client->region}}" type="text" class="form-control" name="region">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('zip_code')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Código postal <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-zip_code" type="text" value="{{$client->zip_code}}" class="form-control" name="zip_code">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('country')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-country">Pais <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-country" type="text" value="{{$client->country}}" class="form-control" name="country">
                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('clients.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
