$('button[data-action=show]').click(function(e) {
    e.preventDefault();
    $("#resultado").html("");
    $('#'+bulkConfig.modalName).modal('show');
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
                'soft':bulkConfig.soft,
                'model':bulkConfig.model,
                'restore':bulkConfig.restore
            },
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (response) {
                console.log(response);
                $('#'+bulkConfig.modalName).modal('toggle');
                if(response.error){
                    const errorMsg = bulkConfig.restore ? 'Los siguientes usuarios no se han restaurado: ':
                        'Los siguientes usuarios no se han eliminado: ';
                    toastr.error(errorMsg + response.failed);

                }else{
                    const successMsg = bulkConfig.restore ? 'Se han restaurado correctamente'  : 'Se han eliminado correctamente'
                    toastr.success(successMsg);
                }
                setTimeout(()=>{
                    location.reload();
                },500);

            }
        });
    }

});
