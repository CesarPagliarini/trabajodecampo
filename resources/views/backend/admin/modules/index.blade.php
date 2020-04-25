@extends('layouts.content-panel')
@section('page-name')
    Modulos
@endsection
@section('content')

    @create('modulesForm')
    <a href="{{ route('modules.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
    @delete('modulesForm')
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
            <th>Descripción</th>
            <th>Relacion interna</th>
            <th>Icono</th>
            <th>Orden</th>
            <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($modules as $module)
        <tr>
            <td valign="top" class="check-mail">
                <input type="checkbox"
                       class="i-checks"
                       value="{{$module->id}}"
                       name="ids[]">
            </td>

            <td>
                <a class="accion"
                   @update('modulesForm') href="{{route('modules.edit', ['id'=>$module->id])}}" @endif >
                {{$module->name}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('modulesForm') href="{{route('modules.edit', ['id'=>$module->id])}}" @endif >
                {{$module->description}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('modulesForm') href="{{route('modules.edit', ['id'=>$module->id])}}" @endif >
                {{$module->internal_handler}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('modulesForm') href="{{route('modules.edit', ['id'=>$module->id])}}" @endif >
                    <i class="{{$module->icon}}" aria-hidden="true"></i>

                </a>
            </td>
            <td>
                <a class="accion"
                   @update('modulesForm') href="{{route('modules.edit', ['id'=>$module->id])}}" @endif >
                {{$module->order}}
                </a>
            </td>
            <td>
                <a href="{{route('forms.edit', [$module->id])}}" class="accion">
                    @if(($module->state)==0)
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
            ¿Esta seguro de eliminar este modulo?
        @endslot
        @slot('model')
            module
        @endslot
    @endcomponent
@endsection

@section('custom-scripts')
    <script src="{{asset('js/requests/bulk-delete.js')}}"></script>
@endsection
