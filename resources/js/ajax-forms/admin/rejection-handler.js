
$(document).ready(() => {

    let message = '';
    $('.summernote').summernote({
        height: 100,   //set editable area's height
        toolbar: false,
        placeholder: 'Indique el motivo de rechazo',
        callbacks: {
            onChange: function(contents) {
                message = contents;
            }
        }
    });
    $('#rejectOrder').click(() =>{
        message = message.replace(/<\/?[^>]+(>|$)/g, "");
        if(message.length < 15){
            toastr.error('El motivo de rechazo debe tener al menos 15 caracteres.')
        }else{
            const token = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': token}
            });
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'order_id':orderId,
                    'observation': message,
                    _method:'POST',
                },
                success:  function (response) {
                    if(response.error){
                        toastr.error('Han ocurrido errores, intente luego.')
                    }else{
                        toastr.success('Se ha rechazado con exito la orden.')
                        window.location.replace($('#backbutton').attr('href'));
                    }

                }
            });
        }
    });
});


