@extends('frontend.sites.shifts-store.layout')

@section('content')
    @include('frontend.sites.shifts-store.headers.about-us')

    <section class="ftco-section ftco-no-pb ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{asset('sites/shifts-store/images/bg-2.jpg)')}});">
                        <a href="https://vimeo.com/45830194" class="icon popup-vimeo d-flex justify-content-center align-items-center">
                            <span class="icon-play"></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 py-md-5 pb-5 wrap-about pb-md-5 ftco-animate">
                    <div class="heading-section mb-4 mt-md-5">
                        <span class="subheading">Sobre nosotros</span>
                        <h2 class="mb-4">Bienvenido a Sissors Fire</h2>
                    </div>
                    <div class="pb-md-5">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab beatae commodi debitis dignissimos error esse eum exercitationem fuga impedit ipsa laborum, non omnis pariatur perferendis quae sit, unde vitae, voluptate..</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium amet, aspernatur aut dignissimos dolorem error esse explicabo hic impedit minus nihil omnis praesentium quaerat quia quo quod, quos veritatis voluptatibus!.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

   @include('frontend.sites.shifts-store.sliders.professionals')






@endsection
