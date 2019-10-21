<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">

    @yield('custom-styles')
    <!-- Scripts -->
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <script src="{{ asset('js/panel.js') }}"></script>
</head>
<body>
<div id="wrapper">
    @yield('application')
</div>
    @include('backend.alerts.common-alerts')
    @yield('custom-scripts')
</body>

</html>
