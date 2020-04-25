@extends('frontend.sites.shifts-store.layout')

@section('content')

<section class="ftco-section ftco-pricing">
    <div class="container">
        <div class="row justify-content-center pb-3">
            <div class="col-md-10 heading-section text-center ftco-animate">
                <span class="subheading">Perfil</span>
                <h2 class="mb-4">Turnos</h2>
                <p>Aqui podras ver tus proximos turnos</p>
            </div>
        </div>
        <div class="row">
            @if($owned_shifts)
            @forelse($owned_shifts as $key => $shift)

                <div class="col-md-3 ftco-animate">
                    <div class="pricing-entry pb-5 text-center">
                        <div>
                            <h3 class="mb-4">En {{$shift->days_remain}} dias</h3>
                            <p><span class="price" id="selected_service_{{$key}}"
                                     >{{$shift->service_name}}</span></p>
                        </div>
                        <ul>
                            <li>{{$shift->professional_name}} {{$shift->professional_last_name}}</li>
                            <li>
                                <p>{{$shift->attention_place_name}}</p>
                                <span>{{$shift->attention_place_address}}</span>
                                <span class="m-2">{{$shift->attention_place_number}}</span>
                            </li>
                            <li id="selected_date_{{$key}}">{{$shift->schedule_date}}</li>
                            <li id="selected_hour_{{$key}}">De: {{$shift->from}} a {{$shift->to}} Aprox.</li>
                        </ul>
                        <p class="button text-center"><a id="{{$key}}" class="btn btn-primary px-4 py-3 reservHandler">Cancelar</a></p>
                    </div>
                </div>

            @empty
            @endforelse
            @endif
        </div>
    </div>
</section>
@endsection


@section('custom-scritps')
    <script>
        $(document).ready(()=>{$('.nav').addClass('navbar-dark')})
    </script>
@endsection


@section('custom-styles')
    <style>
        .nav-link {
            color:black!important;
        }
    </style>
@endsection

