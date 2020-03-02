<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ str_replace('_', '', config('app.name')) }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/front/front-layout.css') }}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/footable/footable.core.css')}}" rel="stylesheet">
    <script src="{{ asset('js/front/front-layout.js') }}"></script>
    @yield('custom-styles')

</head>
<body id="page-top" class="landing-page no-skin-config">
@include('frontend.sites.product-store.partials.nav')

@yield('content')

@include('frontend.sites.product-store.partials.footer')

<script src="{{ asset('js/general-front.js') }}"></script>
@yield('custom-scripts')

@yield('modals')

@include('frontend.sites.product-store.modals.registermodal')
@include('frontend.sites.product-store.modals.loginmodal')
@include('frontend.sites.product-store.modals.cartmodal')

</body>
</html>
