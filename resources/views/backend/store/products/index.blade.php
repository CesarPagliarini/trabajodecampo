@extends('layouts.content-panel')
@section('page-name')
    Productos
@endsection
@section('content')

    @create('product')
    <a href="{{ route('products.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
    @delete('product')
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
            <th>Categoria</th>
            <th>Marca</th>
            <th>Precio</th>

        </tr>
        </thead>
        <tbody>
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
                       @update('products') href="{{route('products.edit', ['id'=>$product->id])}}" @endif >
                    {{$product->name}}
                    </a>
                </td>
                <td>
                    <a class="accion"
                       @update('products') href="{{route('products.edit', ['id'=>$product->id])}}" @endif >
                    {{$product->description}}
                    </a>
                </td>
                <td>
                    <a class="accion"
                       @update('products') href="{{route('products.edit', ['id'=>$product->id])}}" @endif >
                    {{$product->category->name}}
                    </a>
                </td>
                <td>
                    <a class="accion"
                       @update('products') href="{{route('products.edit', ['id'=>$product->id])}}" @endif >
                        {{$product->brand->name}}
                    </a>
                </td>
                <td>
                    <a class="accion"
                       @update('products') href="{{route('products.edit', ['id'=>$product->id])}}" @endif >
                        {{$product->price->value}}
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
            deleteProduct
        @endslot
        @slot('question')
            ¿Esta seguro de eliminar este producto, esta accion es irreversible?
        @endslot
    @endcomponent

@endsection

@section('custom-scripts')
    <script>
        const bulkConfig = {
            'model': 'product',
            'soft':true,
            'modalName':'deleteProduct'
        }
    </script>
    <script src="{{asset('js/requests/bulk-delete.js')}}"></script>
@endsection
