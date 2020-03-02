@extends('frontend.sites.shifts-store.layout')

@section('content')

    @include('frontend.sites.shifts-store.headers.home')

    <section class="ftco-section ftco-no-pt ftco-no-pb" id="request-shift">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="col-md text-center d-flex align-items-stretch">
                    <div class="services-wrap d-flex align-items-center img"
                         style="background-image: url({{asset('sites/shifts-store/images/formen.jpg')}});">
                        <div class="text">
                            <h3>For Men</h3>
                            <p><a href="{{route('frontend.galery')}}"  class="btn-custom">Ver fotos <span class="ion-ios-arrow-round-forward"></span></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-items-stretch">
                    <div class="text-about py-5 px-4">
                        <h1 class="logo">
                            <a href="#"><span class="flaticon-scissors-in-a-hair-salon-badge"></span>Sissors fire</a>
                        </h1>
                        <h2>Bienvenido a nuestro salon</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aut consectetur deserunt dignissimos distinctio, doloribus harum impedit ipsa, magnam molestias numquam perspiciatis quam quos sapiente suscipit ullam vel, voluptatibus voluptatum.
                        </p>
                        <p class="mt-3"><a href="{{route('frontend.about.us')}}" class="btn btn-primary btn-outline-primary">Conocenos</a></p>
                    </div>
                </div>
                <div class="col-md text-center d-flex align-items-stretch">
                    <div class="services-wrap d-flex align-items-center img" style="background-image: url({{asset('sites/shifts-store/images/forwomen.jpg')}});">
                        <div class="text">
                            <h3>For Women</h3>
                            <p><a href="{{route('frontend.galery')}}" class="btn-custom">Ver fotos <span class="ion-ios-arrow-round-forward"></span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.sites.shifts-store.partials.services')




@endsection


@section('custom-scritps')

@endsection


@section('custom-styles')

@endsection


