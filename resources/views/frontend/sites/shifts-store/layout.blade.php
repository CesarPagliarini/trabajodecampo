
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ str_replace('_', '', config('app.name')) }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:500,600,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/open-iconic-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/aos.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/bootstrap-datepicker.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/jquery.timepicker.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/flaticon.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/icomoon.css')}}">
        <link rel="stylesheet" href="{{asset('sites/shifts-store/css/style.css')}}">

        @yield('custom-styles')
    </head>
    <body>

    @include('frontend.sites.shifts-store.partials.nav')

    @yield('content')


    @yield('modals')
    @include('frontend.sites.shifts-store.partials.footer')
    @include('frontend.sites.shifts-store.partials.spinner')

    <script src="{{asset('sites/shifts-store/js/jquery.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/popper.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/aos.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/scrollax.min.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/main.js')}}"></script>
    <script src="{{asset('sites/shifts-store/js/custom-shifts-scripts.js')}}"></script>


        @include('frontend.sites.shifts-store.modals.register')

        @include('frontend.sites.shifts-store.modals.loginmodal')

        @yield('custom-scripts')
    <style>
        a{
            cursor: pointer!important;
        }
    </style>
    </body>
</html>
