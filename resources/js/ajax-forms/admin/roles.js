$('button[data-action=show]').click(function(e) {
    e.preventDefault();
    $("#resultado").html("");
    $('#deleteRoles').modal('show');
});
$('button[data-action=delete]').click(function(e) {
    e.preventDefault();
    const ids = $('[name="roles_ids[]"]:checked').map(function () {
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
        url: "roles/bulk-delete",
        data: {'ids':ids, _method:'POST'},
        beforeSend: function () {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success:  function (response) {
            $('#deleteRoles').modal('toggle');
            if(response.error){
                toastr.error('Los siguientes roles no se han eliminado: '+response.failed);

            }else{
                toastr.success('Se han eliminado correctamente');
            }
            setTimeout(()=>{
                location.reload();
            },500);

        }
    });
});
