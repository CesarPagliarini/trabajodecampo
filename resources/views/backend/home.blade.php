@extends('layouts.content-panel')

@section('content')
    <div class="col-lg-3">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-envelope-o fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                    <span> Productos  </span>
                    <h2 class="font-bold">260</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-envelope-o fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                    <span> Clientes </span>
                    <h2 class="font-bold">12</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-envelope-o fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                    <span> Pedidos entregados </span>
                    <h2 class="font-bold">2</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-envelope-o fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                    <span> </span>
                    <h2 class="font-bold">260</h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-styles')

    <style>
        .box-custom{
            background-color: #2f4050!important;
        }
    </style>

@endsection
