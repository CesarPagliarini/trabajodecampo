<div class="carousel-item active">
    <div class="container">
        <div class="row">
            @forelse($products as $product)
                @include('frontend.sites.product-store.partials.product-item')
            @empty

            @endforelse
        </div>
    </div>
</div>
