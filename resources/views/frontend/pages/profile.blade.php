@extends('layouts.app')

@section('content')
    <section id="store" class="white-section" style="padding-top:25px!important;">
        <div class="container">
            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="{{asset('img/random/usuario.png')}}" class="rounded-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    {{$user->name}}
                                </h2>
                                <h4>{{$user->last_name}}</h4>
                                <small>
                                    Usuario de Genesis desde {{$user->createdParsed}}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <table class="table small m-b-xs">
                        <tbody>
                        <tr>
                            <td>
                                <strong>Nombre: </strong> {{$user->name}}
                            </td>
                            <td>
                                <strong>Apellido: </strong> {{$user->last_name}}
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>Direccion: </strong> {{$user->address}}
                            </td>
                            <td>
                                <strong>Email: </strong> {{$user->email}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>DNI</strong> {{$user->document}}
                            </td>
                            <td>
                                <strong>Fecha de nacimiento</strong> {{$user->birthday_date}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="button" class="btn btn-xs btn-block btn-primary"> Editar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <h3>Ordenes de pedido totales</h3>
                    <h1 class="no-margins">{{$user->salesOrders->count()}}</h1>
                    <div id="sparkline1"><canvas style="display: inline-block; width: 247.25px; height: 50px; vertical-align: top;" width="247" height="50"></canvas></div>
                </div>
            </div>
            <div class="ibox-content">

                @if($user->hasOrders())
                @foreach($user->salesOrders->sortByDesc('created_at') as $order)
                <table class="footable table"
                       data-page-size="8" data-filter=#filter >
                    <thead>
                    <tr>
                        <th>Identificador</th>
                        <th>Fecha de solicitud</th>
                        <th>Cantidad de productos</th>
                        <th>Estado</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr class="footable-detail full-width" >
                        <td class="footable-visible ">
                            {{str_pad($order->identifier, 10, "0", STR_PAD_LEFT)}}
                        </td>
                        <td class="footable-visible">
                            {{$order->createdParsed}}
                        </td>
                        <td class="footable-visible">
                            {{$order->details->count()}}
                        </td>


                        <td class="footable-visible" >
                            {!!$order->state->icon!!}
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
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" >
                                <div class="pull-right">Sub total:  AR$ {{$order->sub_total}} --</div>
                                <button class="btn btn-outline btn-primary dim btn-sm" type="button"><i class="fa fa-download"></i></button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                @endforeach
                @endif
            </div>
        </div>
    </section>

@endsection

@section('custom-scripts')

@endsection


@section('custom-styles')
    <style>
        .navbar{
            background-color: #676a6c!important;
            color:white!important;
        }
        a.nav-link{
            color:white!important;
        }
    </style>
@endsection
