@extends('layouts.content-panel')
@section('page-name')
    Formularios
@endsection
@section('content')

    @create('formsForm')
    <a href="{{ route('forms.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
    @delete('formsForm')
    <button data-placement="bottom"
            title="Borrar"
            type="button"
            class="btn btn-danger accion"
            data-action="show">
        Eliminar
    </button>
    @enddelete

    <div class="hidden" id="page-loader">
        <span class="preloader-interior"></span>
    </div>

    <input type="text" class="form-control
    searchform col-md-3 pull-right"
           id="filter" placeholder="Buscar...">

    <table class="footable table table-stripped"
           data-page-size="8" data-filter=#filter >
        <thead>
        <tr>
            <td class="check-mail">
                <input type="checkbox" class="i-checks todo">
            </td>
            <th>Nombre</th>
            <th>Módulo</th>
            <th>Clave</th>
            <th>Ruta</th>
            <th>Orden</th>
            <th class="pull-right">Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($forms as $form)
        <tr>
            <td valign="top" class="check-mail">
                <input type="checkbox"
                       class="i-checks"
                       value="{{$form->id}}"
                       name="ids[]">
            </td>

            <td>
                <a class="accion"
                   @update('formsForm') href="{{route('forms.edit', ['id'=>$form->id])}}" @endif >
                {{$form->name}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('formsForm') href="{{route('forms.edit', ['id'=>$form->id])}}" @endif >
                {{$form->module? $form->module->name : 'Menu lateral'}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('formsForm') href="{{route('forms.edit', ['id'=>$form->id])}}" @endif >
                {{$form->key}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('formsForm') href="{{route('forms.edit', ['id'=>$form->id])}}" @endif >
                {{$form->target}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('formsForm') href="{{route('forms.edit', ['id'=>$form->id])}}" @endif >
                {{$form->order}}
                </a>
            </td>

            <td>
                <a href="{{route('forms.edit', [$form->id])}}" class="accion">
                    @if(($form->state)==0)
                        <span class="label label-danger pull-right ">Inactivo</span>
                    @else
                        <span class="label label-primary pull-right ">Activo</span>
                    @endif
                </a>
            </td>

        </tr>
            @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">
            <ul class="pagination pull-right"></ul>
        </td>
    </tr>
    </tfoot>
    </table>
    @component('backend.modals.sure-delete')
        @slot('question')
            ¿Esta seguro de eliminar este formulario?
        @endslot
        @slot('model')
            form
        @endslot
    @endcomponent
@endsection

@section('custom-scripts')
    <script src="{{asset('js/requests/bulk-delete.js')}}"></script>
@endsection
