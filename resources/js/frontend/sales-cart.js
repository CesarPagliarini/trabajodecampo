
const productsInCart = [];
let order = [];


$(document).ready(function(){
    $('.cartButtonWrapper').removeClass('hidden');
    $(document).bind('sentSaleOrder', function(e, obj) {


        const data = obj;
        const csrf = $('meta[name="csrf-token"]').attr('content');

        const url = $('#cartOrderUrl').val();
        console.log('obj',obj);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf,
            }
        });
        $.ajax({
            type:'POST',
            url:url,
            data:data,
            success:function(data){
                if(data.success){
                    toastr.success('Excelente, estaremos en contacto, puedes seguir tu orden de compra en tu perfil')
                }
                window.location.replace('/client-profile');
            }
        });

    });

    $(document).bind('addThisProductToCart', function(e, obj) {
        let item = obj.item;
        let inCart = productsInCart.find( (el) => {
            if(el.id !== undefined && item !== undefined){
                return  el.id == item.id
            }
        });
        if(item !== undefined && item !== 'undefined' && !inCart)
        {
            $('#productCartContainer').append( `
                 <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <tbody>
                                <tr>
                                    <td width="90">
                                        <div class="cart-product-imitation">
                                        </div>
                                    </td>
                                    <td class="desc">
                                        <h3>
                                            <a href="#" class="text-navy">
                                                ${item.name}
                                            </a>
                                        </h3>

                                        <dl class="small m-b-none">
                                            <dt>Descripción</dt>
                                            <dd>${item.description}</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a  class="text-muted removeItem" value="${item.id}"><i class="fa fa-trash"></i> Quitar del carrito</a>
                                        </div>
                                    </td>

                                    <td >
                                        $ ${item.precio}
                                    </td>
                                    <td width="65">
                                        <input id="itemUnitPrice${item.id}" type="number" min=1 value=1 class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" disabled="disabled" id="itemTotalPrice${item.id}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                `);

            productsInCart.push(item);
            $('#cartItemCount').text(productsInCart.length);
            toastr.success('Se ha agregado '+ item.name +' al carrito');
            productsInCart.forEach( (el) => {
                let cantidad = $('#itemUnitPrice'+item.id);
                let total =  $('#itemTotalPrice'+item.id);
                total.val(cantidad.val()*item.precio);
                cantidad.change( () => {
                    total.val(cantidad.val()*item.precio);
                });
            });
        }//endif undefined
        else{
            if(item !== undefined){
                toastr.error('Ya has agregado '+ item.name +' al carrito');
            }
        }
    });

    let sent = false;
    $('#cartOrderSubmit').click( () => {
        if(productsInCart.length > 0 ){
            $('#cartContent').addClass('hidden');
            $('#cartLoading').removeClass('hidden');


            productsInCart.forEach( (el) => {
                let product = {
                    cantidad: $('#itemUnitPrice'+el.id).val(),
                    product_id: el.id
                };
                order.push(product)
            });

            $(document).trigger('sentSaleOrder', [ { order } ]);
            order = [];

        }
    });

    $('.addToCartButton').click((ev) =>{
        let clicked = $(ev.target).attr('id');
        let item = products.find( (el) => { return  el.id == clicked } );
        $(document).trigger('addThisProductToCart', [ { item }]);
    });
});
