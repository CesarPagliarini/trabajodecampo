@extends('layouts.content-panel')
@section('page-name')
    {{$title}}
@stop
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight" >
        <div class="row">
            <div class="col-lg-12">
                <div class="row form-group">
                    <div class="col-md-12">
                        <a href="{{ route($routeBack) }}" id="backbutton" class="btn btn-white" type="submit">Volver</a>
                        @if(isset($rejectRoute) && $rejectRoute)
                            <button class="btn btn-outline btn-danger" type="button"
                                    id="rejectOrder"
                                    onclick="$('#rejectOrderShure').modal()">
                                Rechazar
                            </button>
                        @endif
                        @if($canUpdate)
                            <form action="{{route('orders.update', $order)}}" method="POST" class="float-right">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-primary" type="submit" id="forwardButton">{{$forwardButton}}</button>
                            </form>
                        @endif
                        @if(isset($observation) && $observation)
                            <a  onclick="$('#observationModal').modal()" class="btn btn-danger btn-outline btn-bitbucket pull-right">
                                <i class="fa fa-times-rectangle-o"></i> Observaciones
                            </a>
                        @endif
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <table class="footable table table-stripped  footable-loaded ">
                            <thead>
                            <tr>
                                <th class="footable-visible footable-sortable">
                                    Identificador
                                </th>
                                <th class="  footable-visible footable-sortable">
                                    Fecha de solicitud
                                </th>
                                <th class=" text-center footable-visible footable-sortable">
                                    Cliente
                                </th>
                                <th class=" text-center footable-visible footable-sortable">
                                    Última fecha de modificacion
                                </th>
                                <th class=" text-center footable-visible footable-sortable">
                                    Encargado de ultima modificacion
                                </th>
                                <th class=" text-center footable-visible footable-sortable">
                                   Stock actual
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="" style="">
                                <td class="footable-visible">{{$order->fullIdentifier}}</td>
                                <td class="footable-visible">{{$order->createdParsed}}</td>
                                <td class="footable-visible  text-center">{{$order->client->fullName}}</td>
                                <td class="footable-visible  text-center">{{$order->lastModified}} </td>
                                <td class="footable-visible text-center">{{$order->lastAdmin}} </td>
                            </tr>
                            @foreach($order->details as $detail)
                                <tr class="footable-row-detail" >
                                    <td class="footable-row-detail-cell" style="
                                    border-top:solid 1px #1ab394!important;
                                    border-bottom:solid 1px #1ab394!important" colspan="5">
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
                                    <td style="border-top:solid 1px #1ab394!important;
                                            border-bottom:solid 1px #1ab394!important;">
                                        <div class="footable-row-detail-inner"
                                        @if(! $detail->product->stock > 0 || ($detail->quantity > $detail->product->stock) )
                                            style="color: #ec4758!important;"
                                        @else
                                             style="color: #1ab394!important;"
                                        @endif
                                        >
                                            <div class="footable-row-detail-row">
                                                <div class="footable-row-detail-name">Stock actual:</div>
                                                <div class="footable-row-detail-value">{{$detail->product->stock}}</div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6" class="footable-visible">
                                    <ul class="pagination pull-right float-right">
                                     <li> Subtotal: AR$ {{$order->sub_total}} --</li>
                                    </ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@include('backend.modals.cancelOrderMessage')

@if(isset($observation) && $observation)
    @include('backend.modals.observations')

@endif

@section('custom-styles')
    <link rel="stylesheet" href="{{asset('css/plugins/summernote/summernote-bs4.css')}}">
@endsection

@section('custom-scripts')
    <script>const orderId = "{{$order->id}}"; const url = "{{route('reject-order')}}";</script>
    <script src="{{asset('js/reject.js')}}"></script>

    <script>
        $(document).ready(()=>{
            $('.summerNoteObservation').summernote({
                height: 100,   //set editable area's height
                toolbar: false,
            });
            $('#summerNoteObservation').summernote('disable');
        });
    </script>
@endsection
