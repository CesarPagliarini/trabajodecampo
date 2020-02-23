@extends('layouts.content-panel')
@section('page-name')
    Especialidades
@endsection
@section('content')

    @create('specialtiesForm')
    <a href="{{ route('specialties.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
    @delete('specialtiesForm')
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
            <th class="pull-right">Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($specialties as $specialty)
        <tr>
            <td valign="top" class="check-mail">
                <input type="checkbox"
                       class="i-checks"
                       value="{{$specialty->id}}"
                       name="ids[]">
            </td>
           <td>
                <a class="accion"
                   @update('specialtiesForm') href="{{route('specialties.edit', ['id'=>$specialty->id])}}" @endif >
                    {{$specialty->name}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update('specialtiesForm') href="{{route('specialties.edit', ['id'=>$specialty->id])}}" @endif >
                    {{$specialty->description}}
                </a>
            </td>
            <td>
                <a href="{{route('specialties.edit', ['id'=>$specialty->id])}}" class="accion">
                    @if(($specialty->state)==0)
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
            ¿Esta seguro de eliminar esta especialidad?
        @endslot
        @slot('model')
            category
        @endslot
    @endcomponent
@endsection

@section('custom-scripts')
    <script src="{{asset('js/requests/bulk-delete.js')}}"></script>
@endsection

