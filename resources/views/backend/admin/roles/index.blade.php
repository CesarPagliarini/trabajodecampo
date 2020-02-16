@extends('layouts.content-panel')
@section('page-name')
    Roles
@endsection
@section('content')

    @create('roles')
    <a href="{{ route('roles.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
    @delete('roles')
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
            <th>Descripcion</th>
            <th>Acciones</th>
            <th class="pull-right">Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
        <tr>
            <td valign="top" class="check-mail">
                <input type="checkbox"
                       class="i-checks"
                       value="{{$role->id}}"
                       name="ids[]">
            </td>
           <td>
                <a class="accion"
                   @update('roles') href="{{route('roles.edit', ['id'=>$role->id])}}" @endif >
                    {{$role->name}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('roles') href="{{route('roles.edit', ['id'=>$role->id])}}" @endif >
                    {{$role->description}}
                </a>
            </td>
            <td>
                <a class="accion "
                   @update('roles') href="{{route('roles.show', ['id'=>$role->id])}}" @endif >
                <div class="col-md-2 offset-1">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>

                </a>
            </td>
            <td>
                <a href="{{route('users.edit', [$role->id])}}" class="accion">
                    @if(($role->state)==0)
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
            ¿Esta seguro de eliminar este rol?
        @endslot
        @slot('model')
            role
        @endslot
    @endcomponent
@endsection

@section('custom-scripts')
    <script src="{{asset('js/requests/bulk-delete.js')}}"></script>
@endsection
