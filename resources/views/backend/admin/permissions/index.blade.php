@extends('layouts.content-panel')
@section('page-name')
    Permisos
@endsection
@section('content')

    @create('forms')
    <a href="{{ route('permissions.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
    @delete('permissions')
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
            <th>Acción</th>
            <th>Icono</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
        <tr>
            <td valign="top" class="check-mail">
                <input type="checkbox"
                       class="i-checks"
                       value="{{$permission->id}}"
                       name="ids[]">
            </td>

            <td>
                <a class="accion"
                   @update('permissions') href="{{route('permissions.edit', ['id'=>$permission->id])}}" @endif >
                {{$permission->name}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('permissions') href="{{route('permissions.edit', ['id'=>$permission->id])}}" @endif >
                {{$permission->description}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('permissions') href="{{route('permissions.edit', ['id'=>$permission->id])}}" @endif >
                {{$permission->action}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('permissions') href="{{route('permissions.edit', ['id'=>$permission->id])}}" @endif >
                    <i class="{{$permission->icon}}" aria-hidden="true"></i>

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
            ¿Esta seguro de eliminar este permiso?
        @endslot
        @slot('model')
            permisson
        @endslot
    @endcomponent
@endsection

@section('custom-scripts')
    <script src="{{asset('js/requests/bulk-delete.js')}}"></script>
@endsection
