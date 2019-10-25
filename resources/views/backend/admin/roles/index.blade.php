@extends('layouts.content-panel')
@section('page-name')
    Roles
@endsection
@section('content')

    @delete('roles')
    <button data-placement="bottom"
            title="Borrar"
            type="button"
            class="btn btn-danger accion"
            data-action="show">
        Eliminar
    </button>
    @enddelete

    @create('roles')
    <a href="{{ route('roles.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
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
            <th>Descripcion</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $rol)
        <tr>
            <td valign="top" class="check-mail">
                <input type="checkbox"
                       class="i-checks"
                       value="{{$rol->id}}"
                       name="roles_ids[]">
            </td>
           <td>
                <a class="accion"
                   @update('roles') href="{{route('roles.edit', ['id'=>$rol->id])}}" @endif >
                    {{$rol->name}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('roles') href="{{route('roles.edit', ['id'=>$rol->id])}}" @endif >
                    {{$rol->description}}
                </a>
            </td>
            <td>
                <a class="accion "
                   @update('roles') href="{{route('roles.edit', ['id'=>$rol->id])}}" @endif >
                <div class="col-md-3 offset-1">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>

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
        @slot('modelToDelete')
            deleteRoles
        @endslot
        @slot('question')
            ¿Esta seguro de eliminar este rol?
        @endslot
    @endcomponent

@endsection

@section('custom-scripts')
    <script src="{{asset('js/requests/role-form.js')}}"></script>
@endsection
