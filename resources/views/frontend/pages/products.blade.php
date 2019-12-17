
@extends('layouts.app')


@section('content')
<section id="store" class="white-section" style="padding-top:25px!important;">
    <div class="container">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                @foreach($products as $product)
                    @include('frontend.partials.product-item')
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-scripts')
    <script> const products = {!! json_encode($products->toArray()) !!}</script>
    <script src="{{ asset('js/front/sales-cart.js') }}"></script>

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
