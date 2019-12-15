
@extends('layouts.app')


@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3">
            <div class="ibox">
                <div class="ibox-content product-box">

                    <div class="product-imitation">
                        [ INFO ]
                    </div>
                    <div class="product-desc">
                                <span class="product-price">
                                {{$product->price->value}}
                                </span>
                        <small class="text-muted">{{$product->category->name}}</small>
                        <a href="#" class="product-name"> {{$product->name}}</a>



                        <div class="small m-t-xs">
                            {{$product->description}}
                        </div>
                        @auth()
                            boton para agregar al carrito
                        @else
                            <a
                                href="#loginModal"
                                class="nav-link"
                                data-toggle="modal">Agregar al carrito</a>
                        @endauth

                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>
@endsection
