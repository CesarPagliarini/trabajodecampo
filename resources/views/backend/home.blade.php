@extends('layouts.content-panel')

@section('content')

    @switch(env('APP_SITE'))
        @case('shifts-store')
            @include('backend.partials.homes.shifts-store')
        @break
        @case('product-store')
            @include('backend.partials.homes.product-store')
        @break


    @endswitch


@endsection

@section('custom-scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>const reporter = "{{route('backend.reports')}}";</script>

@endsection
@section('custom-styles')

    <style>
        .box-custom{
            background-color: #2f4050!important;
        }
    </style>
@endsection
