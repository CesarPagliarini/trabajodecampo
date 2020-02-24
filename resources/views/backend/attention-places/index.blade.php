@extends('layouts.content-panel')
@section('page-name')
    Centros de atencion
@endsection
@section('content')

    @create('attentionPlacesForm')
    <a href="{{ route('attention-places.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
    @delete('attentionPlacesForm')
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
        @foreach($attention_places as $attention_place)
            <tr>
                <td valign="top" class="check-mail">
                    <input type="checkbox"
                           class="i-checks"
                           value="{{$attention_place->id}}"
                           name="ids[]">
                </td>
                <td>
                    <a class="accion"
                       @update('attentionPlacesForm') href="{{route('attention-places.edit', ['id'=>$attention_place->id])}}" @endif >
                    {{$attention_place->name}}
                    </a>
                </td>
                <td>
                    <a class="accion"
                       @update('attentionPlacesForm') href="{{route('attention-places.edit', ['id'=>$attention_place->id])}}" @endif >
                    {{$attention_place->description}}
                    </a>
                </td>
                <td>
                    <a href="{{route('attention-places.edit', ['id'=>$attention_place->id])}}" class="accion">
                        @if(($attention_place->state)==0)
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
            ¿Esta seguro de eliminar estos servicios?
        @endslot
        @slot('model')
            attentionPlace
        @endslot
    @endcomponent
@endsection

@section('custom-scripts')
    <script src="{{asset('js/requests/bulk-delete.js')}}"></script>
@endsection

