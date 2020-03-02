<div class="col-md-4">
    <div class="ibox">
        <div class="ibox-content product-box">
            <div class="product-imitation">
                [ INFO ]
            </div>
            <div class="product-desc">

                    <span class="product-price">
                        {{$product->price}}
                    </span>
                <small class="text-muted">{{$product->category->name}}</small>
                <a href="#" class="product-name"> {{$product->name}}</a>

                <div class="small m-t-xs">
                    {{$product->description}}
                </div>
                @auth()
                    <div class="mt-4 hidden cartButtonWrapper">
                        <button class="btn btn-outline btn-primary dim addToCartButton"
                                type="button"
                                id="{{$product->id}}"

                        >
                            <i class="fa fa-cart-arrow-down"></i>
                        </button>
                    </div>
                @else
                    <div class="mt-4 hidden cartButtonWrapper" >
                        <button class="btn btn-outline btn-primary dim" type="button"
                        id="nonLogedCart"
                        onclick="$('#loginModal').modal()">
                            <i class="fa fa-cart-arrow-down"></i></button>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
