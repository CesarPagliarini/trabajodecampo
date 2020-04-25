@extends('frontend.sites.product-store.layout')

@section('content')
    @include('frontend.sites.product-store.sliders.home-slider')
    <section id="store" class="gray-section" style="padding-top:25px!important;">
        <div class="container">
            @include('frontend.sites.product-store.sliders.product-slider')
        </div>
    </section>
    @include('frontend.sites.product-store.pages.our-team')
@endsection


@section('custom-scritps')

@endsection


@section('custom-styles')
    <style>
        .landing-page .header-back.one {
            background: url({{asset('img/home-slider/header_one.jpg')}}) 50% 0 no-repeat;
        }
        .landing-page .header-back.two {
            background: url({{asset('img/home-slider/header_two.jpg')}}) 50% 0 no-repeat;
        }
        .landing-page .contact {
            background: url({{asset('img/footers/word_map.png')}}) 50% 0 no-repeat;
        }
    </style>
@endsection


