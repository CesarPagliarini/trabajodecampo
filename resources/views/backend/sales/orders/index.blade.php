@extends('layouts.content-panel')
@section('page-name')
    {{$title}}
@endsection
@section('content')


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
            <th>Identificador</th>
            <th>Cliente</th>
            <th>Fecha de solicitud</th>
            <th>Monto total</th>

        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        <tr>
            <td valign="top" class="check-mail">
                <input type="checkbox"
                       class="i-checks"
                       value="{{$order->id}}"
                       name="ids[]">
            </td>
           <td>
                <a class="accion"
                    @update($formAccessor) href="{{route($route, ['id'=>$order->id])}}" @endif >
                    {{str_pad($order->identifier, 10, "0", STR_PAD_LEFT)}}
                </a>
            </td>

            <td>
                <a class="accion"
                   @update($formAccessor) href="{{route($route, ['id'=>$order->id])}}" @endif >
                    {{$order->client->fullName}}
                </a>
            </td>
            <td>
                <a class="accion"
                   @update($formAccessor) href="{{route($route, ['id'=>$order->id])}}" @endif >
                    {{$order->createdParsed}}
                </a>
            </td>

            <td>
                <a class="accion"
                   @update($formAccessor) href="{{route($route, ['id'=>$order->id])}}" @endif >
                    AR$ {{$order->sub_total}}
                </a>
            </td>

        </tr>
        @foreach($order->details as $detail)
            <tr class="footable-row-detail" style="margin-top:150px!important">
                <td class="footable-row-detail-cell" colspan="4">
                    <div class="footable-row-detail-inner">
                        <div class="footable-row-detail-row">
                            <div class="footable-row-detail-name">Producto:</div>
                            <div class="footable-row-detail-value">{{$detail->product->name}}</div>
                        </div>
                        <div class="footable-row-detail-row">
                            <div class="footable-row-detail-name">Cantidad: </div>
                            <div class="footable-row-detail-value"> X {{$detail->quantity}}</div>
                        </div>
                        <div class="footable-row-detail-row">
                            <div class="footable-row-detail-name">Precio unitario: </div>
                            <div class="footable-row-detail-value">AR$ {{$detail->unit_price}} --</div>
                        </div>
                        <div class="footable-row-detail-row">
                            <div class="footable-row-detail-name">Subtotal: </div>
                            <div class="footable-row-detail-value">AR$ {{$detail->total_item}} --</div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
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

@endsection

@section('custom-scripts')

@endsection
