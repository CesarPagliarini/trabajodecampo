<div class="carousel-item active">
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                @include('frontend.partials.product-item')
            @endforeach
        </div>
    </div>
</div>

<div class="carousel-item">
    <div class="container">
        <div class="row">

        </div>
    </div>
</div>
