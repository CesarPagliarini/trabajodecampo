$('button[data-action=show]').click(function(e) {
    e.preventDefault();
    $("#resultado").html("");
    $('#deleteUser').modal('show');
});
$('button[data-action=delete]').click(function(e) {
    e.preventDefault();
    const ids = $('[name="users_ids[]"]:checked').map(function () {
        return this.value;
    }).get();
    console.log(ids);
    const token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': token}
    });
    $.ajax({
        type: "POST",
        url: "users/bulk-delete",
        data: {'ids':ids, _method:'POST'},
        beforeSend: function () {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success:  function (response) {
            $('#deleteUser').modal('toggle');
            if(response.error){
                toastr.error('Los siguientes usuarios no se han eliminado: '+response.failed);

            }else{
                toastr.success('Se han eliminado correctamente');
            }
            setTimeout(()=>{
                location.reload();
            },500);

        }
    });
});
