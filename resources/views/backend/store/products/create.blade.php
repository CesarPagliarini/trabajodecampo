@extends('layouts.content-panel')
@section('page-name')
    Nuevo producto
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('products.store')}}"
                        class="form-horizontal offset-1"
                        method="post">
                        @csrf

                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" type="text" class="form-control"
                                       value=""
                                       required
                                       name="name">
                            </div>
                        </div>

                        <div class="form-group row  @if ($errors->has('stock')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Stock <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" type="number" class="form-control"
                                       value=""
                                       required
                                       name="stock">
                            </div>
                        </div>


                        <div class="form-group row @if ($errors->has('description')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Descripcion <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control"
                                       value=""
                                       required
                                       name="description">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('category_id')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Categoria <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control m-b" name="category_id">
                                    @forelse($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                                        @empty
                                            <option selected disabled value="null">Aun no hay categorias cargadas</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>



                        <div class="form-group row @if ($errors->has('price')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Precio en AR$ <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="number" min="1" class="form-control"
                                       value=""
                                       name="price">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-3">

                                <div class="i-checks"><label> <input type="radio" value="1" name="state"  checked> <i></i> Activo </label></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="i-checks"><label> <input type="radio" value="0" name="state" > <i></i> Inactivo </label></div>
                            </div>
                        </div>
                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('products.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
