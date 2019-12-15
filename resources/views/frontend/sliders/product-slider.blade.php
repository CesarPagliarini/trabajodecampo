<div id="inSliderProduct" class="carousel slide" data-ride="carousel" >
    <ol class="carousel-indicators">
        <li data-target="#inSliderProduct" data-slide-to="0" class="active"></li>
        <li data-target="#inSliderProduct" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
            @include('frontend.partials.product-slider-item')
    </div>

    <a class="carousel-control-prev" href="#inSliderProduct" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#inSliderProduct" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>
<div class="row m-b-lg">
    <div class="col-lg-12 text-center">
        <div class="navy-line"></div>
        <a href="{{route('frontend.products')}}" type="submit" class="btn btn-primary  m-b">Ver todos</a>
    </div>
</div>
