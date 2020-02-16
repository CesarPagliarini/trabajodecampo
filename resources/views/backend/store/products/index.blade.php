@extends('layouts.content-panel')
@section('page-name')
    Productos
@endsection
@section('content')

    @create('productForm')
    <a href="{{ route('products.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
    @delete('productForm')
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
            <th>Stock actual</th>
            <th>Descripción</th>
            <th>Categoria</th>
            <th>Precio</th>
            <th>Estado</th>

        </tr>
        </thead>
        <tbody>
        @if(count($products))
        @foreach($products as $product)
            <tr>
                <td valign="top" class="check-mail">
                    <input type="checkbox"
                           class="i-checks"
                           value="{{$product->id}}"
                           name="ids[]">
                </td>
                <td>
                    <a class="accion"
                       @update('productForm') href="{{route('products.edit', ['id'=>$product->id])}}" @endif >
                    {{$product->name}}
                    </a>
                </td>
                <td>
                    <a class="accion"
                       @update('productForm') href="{{route('products.edit', ['id'=>$product->id])}}" @endif >
                    {{$product->stock}}
                    </a>
                </td>
                <td>
                    <a class="accion"
                       @update('productForm') href="{{route('products.edit', ['id'=>$product->id])}}" @endif >
                    {{$product->description}}
                    </a>
                </td>
                <td>
                    <a class="accion"
                       @update('productForm') href="{{route('products.edit', ['id'=>$product->id])}}" @endif >
                    {{$product->category->name}}
                    </a>
                </td>
                <td>
                    <a class="accion"
                       @update('productForm') href="{{route('products.edit', ['id'=>$product->id])}}" @endif >
                         AR$ {{$product->price}}
                    </a>
                </td>
                <td>
                    <a href="{{route('products.edit', [$product->id])}}" class="accion">

                        @if(($product->state)==0)
                            <span class="label label-danger pull-right">Inactivo</span>
                        @else
                            <span class="label label-primary pull-right">Activo</span>
                        @endif
                    </a>
                </td>
            </tr>
        @endforeach
        @else
            No existen productos cargados
        @endif
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
            ¿Esta seguro de eliminar este producto?
        @endslot
        @slot('model')
            product
        @endslot
    @endcomponent
@endsection

@section('custom-scripts')
    <script src="{{asset('js/requests/bulk-delete.js')}}"></script>
@endsection
