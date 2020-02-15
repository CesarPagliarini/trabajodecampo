$('button[data-action=show]').click(function(e) {
    e.preventDefault();
    $("#resultado").html("");
    $('#delete-modal').modal('show');
});
$('button[data-action=delete]').click(function(e) {
    e.preventDefault();
    const ids = $('[name="ids[]"]:checked').map(function () {
        return this.value;
    }).get();
    if(!ids.length){
        $("#resultado").html("Debe seleccionar algo a eliminar");
    }else{
        const token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': token}
        });
        $.ajax({
            type: "POST",
            url: "bulk-delete",
            data: {
                'ids':ids,
                _method:'POST',
                'model':this.id,
            },
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (response) {
                $('#delete-modal').modal('toggle');
                if(response.error){
                    toastr.error(response.message);
                }else{

                    toastr.success(response.message);
                }
                setTimeout(()=>{
                    location.reload();
                },300);

            }
        });
    }

});
