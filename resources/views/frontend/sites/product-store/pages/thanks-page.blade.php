@extends('frontend.sites.product-store.layout')


@section('content')
    <section id="testimonials" class="navy-section testimonials" style="margin-top: 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center wow zoomIn">
                    <i class="fa fa-comment big-icon"></i>
                    <h1>
                        {{$message}}
                    </h1>
                    <div class="testimonials-text">
                        <i>"El miedo es el camino hacia el Lado Oscuro; el miedo lleva a la ira, la ira lleva al odio, el odio lleva al sufrimiento”. "</i>
                    </div>
                    <small>
                        <strong>Te esperamos pronto</strong>
                    </small>
                </div>
            </div>
        </div>

    </section>
@endsection


@section('custom-scritps')
    <script>
        $(document).ready(() => {
            setTimeout(function () {
                window.location = '/'
            }, 2000);
        })
    </script>
@endsection

