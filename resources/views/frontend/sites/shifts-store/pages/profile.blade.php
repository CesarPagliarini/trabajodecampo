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
            <div class="col-md-3 ftco-animate">
                <div class="pricing-entry pb-5 text-center">
                    <div>
                        <h3 class="mb-4">En xxx dias</h3>
                        <p><span class="price">$Costo</span> <span class="per">/ servicio</span></p>
                    </div>
                    <ul>
                        <li>Profesional</li>
                        <li>Especialidad destacada</li>
                        <li>Lugar</li>
                        <li>Fecha</li>
                        <li>Hora</li>

                    </ul>
                    <p class="button text-center"><a href="#" class="btn btn-primary px-4 py-3">Cancelar</a></p>
                </div>
            </div>
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

