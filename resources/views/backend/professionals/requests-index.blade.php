@extends('layouts.content-panel')
@section('page-name')
    Solicitudes de clientes
@endsection
@section('content')
    @create('professionals')
    <a href="{{ route('professionals.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
    @delete('professionals')
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
            <th>Email</th>
            <th class="pull-right">Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($professionals as $professional)
        <tr>
            <td valign="top" class="check-mail">
                <input type="checkbox"
                       class="i-checks"
                       value="{{$professional->id}}"
                       name="ids[]">
            </td>
           <td>
               <a class="accion"
                  @update('professionals') href="{{route('professionals.edit', ['id'=>$professional->id])}}" @endif >
                   {{$professional->name}}
               </a>
           </td>
            <td>
                <a class="accion"
                   @update('professionals')href="{{route('professionals.edit', ['id'=>$professional->id])}}" @endif >
                    {{$professional->email}}
                </a>
            </td>
            <td>
                <a href="{{route('professionals.edit', [$professional->id])}}" class="accion">

                    @if(($professional->state)==0)
                        <span class="label label-danger pull-right">Inactivo</span>
                    @else
                        <span class="label label-primary pull-right">Activo</span>
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
        @slot('modelToDelete')
            deleteUser
        @endslot
        @slot('question')
            ¿Esta seguro de eliminar este usuario?
        @endslot
    @endcomponent

@endsection

@section('custom-scripts')
    <script>
        const bulkConfig = {
            'model': 'user',
            'soft':true,
            'modalName':'deleteUser'
        }
    </script>
    <script src="{{asset('js/requests/bulk-delete.js')}}"></script>
@endsection
