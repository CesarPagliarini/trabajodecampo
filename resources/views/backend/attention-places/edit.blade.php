@extends('layouts.content-panel')
@section('page-name')
    Editar Centro de atencion
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li><a class="nav-link active " data-toggle="tab" href="#general"><i class="fa fa-user"></i> Datos generales</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#professionals"><i class="fa fa-briefcase"></i> Profesionales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('attention-places.update', [$attention_place])}}"
                          class="form-horizontal offset-1"
                          method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$attention_place->name}}"  type="text" class="form-control" name="name">
                                <span class="control-label">
                                    <p>{{ $errors->first('name') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('description')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Descripcion <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$attention_place->description}}" type="text" class="form-control" name="description">
                                <span class="control-label">
                                    <p>{{ $errors->first('description') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('address')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Dirección <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$attention_place->address}}" type="text" class="form-control" name="address">
                                <span class="control-label">
                                    <p>{{ $errors->first('address') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('number')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Número<span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$attention_place->number}}" type="text" class="form-control" name="number">
                                <span class="control-label">
                                    <p>{{ $errors->first('number') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('phone')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Teléfono<span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$attention_place->phone}}" type="text" class="form-control" name="phone">
                                <span class="control-label">
                                    <p>{{ $errors->first('phone') }}</p>
                                </span>
                            </div>
                        </div>



                        <div class="form-group row  @if ($errors->has('floor')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Piso <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$attention_place->floor}}" type="text" class="form-control" name="floor">
                                <span class="control-label">
                                    <p>{{ $errors->first('floor') }}</p>
                                </span>
                            </div>
                        </div>


                        <div class="form-group row  @if ($errors->has('city')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Ciudad <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$attention_place->city}}" type="text" class="form-control" name="city">
                                <span class="control-label">
                                    <p>{{ $errors->first('city') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('province')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Provincia <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$attention_place->province}}" type="text" class="form-control" name="province">
                                <span class="control-label">
                                    <p>{{ $errors->first('province') }}</p>
                                </span>
                            </div>
                        </div>


                        <div class="form-group row  @if ($errors->has('country')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Pais <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" value="{{$attention_place->country}}" type="text" class="form-control" name="country">
                                <span class="control-label">
                                    <p>{{ $errors->first('country') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-3">

                                <div class="i-checks"><label> <input type="radio" value="1" name="state" @if(($attention_place->state)==1) checked="" @endif> <i></i> Activo </label></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="i-checks"><label> <input type="radio" value="0" name="state" @if(($attention_place->state)==0) checked="" @endif > <i></i> Inactivo </label></div>
                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('attention-places.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            @include('backend.partials.tabs.attention-center.professionals')

        </div>
    </div>
@endsection
