@extends('layouts.panel')

@section('application')
    @include('backend.partials.left-nav')
        <div id="page-wrapper" class="gray-bg">
            @include('backend.partials.top-nav')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>@yield('page-name')</h2>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('backend.partials.footer')
        </div>
    @endsection
