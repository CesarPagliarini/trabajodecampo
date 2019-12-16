
<!-- Modal -->
<div class="modal inmodal" tabindex="-1" id="cartModal">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="col-md-9" id="cartContent">

                <input type="hidden" id="cartOrderUrl" value="{{route('client.sent.order')}}">

                <div class="ibox" id="productCartContainer">
                    <div class="ibox-title" id="cartTitle">
                        <span class="float-right">(<strong id="cartItemCount">0</strong>) productos</span>
                        <h5>Productos en tu carrito</h5>
                    </div>
                    </div>
                    <div class="ibox" id="cartButtons">
                        <button class="btn btn-primary float-right" id="cartOrderSubmit"><i class="fa fa fa-shopping-cart"></i>  Confirmar orden</button>
                        <button class="btn btn-white"  data-dismiss="modal"><i class="fa fa-arrow-left"></i> Continuar comprando</button>
                    </div>
            </div>
            <div class="ibox hidden " style="margin-top:10px!important;"  id="cartLoading" >
                @include('frontend.partials.spinner')
                <div class="col-md-12 text-center">
                    <h3 style="margin-top:15px!important;">Estamos procesando tu orden ... </h3>
                </div>

            </div>
        </div>
    </div>
</div>
