<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/front/front-layout.css') }}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/footable/footable.core.css')}}" rel="stylesheet">
    <script src="{{ asset('js/front/front-layout.js') }}"></script>
    @yield('custom-styles')

</head>
<body id="page-top" class="landing-page no-skin-config">
@include('frontend.partials.nav')

@yield('content')

@include('frontend.partials.footer')

<script src="{{ asset('js/general-front.js') }}"></script>
@yield('custom-scripts')

@yield('modals')

@include('frontend.modals.registermodal')
@include('frontend.modals.loginmodal')
@include('frontend.modals.cartmodal')

</body>
</html>
