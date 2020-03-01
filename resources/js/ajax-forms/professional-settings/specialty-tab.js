
$(".specialties_professional_select").select2({width: '100%'});


$('#specialties_professional_select').on('select2:select', function (e) {
    let data = e.params.data;
    let source =  { specialty_id:data.id, action:'attach'};
    updateProfessionalSpecialties(source)
});

$('#specialties_professional_select').on('select2:unselect', function (e) {
    let data = e.params.data;
    let source =  { specialty_id:data.id, action:'dettach'};
    updateProfessionalSpecialties(source)
});


function callApi(url, params = {}){
    const token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': token}
    });
    return $.ajax({
        beforeSend:function() {
            $('#professional-settings-wrapper').addClass('sk-loading')
        },
        type: "POST",
        url: url,
        data: params,
    });
}

function updateProfessionalSpecialties(source){
    const data = {
        professional_id: professional.id,
        specialty_id:source.specialty_id,
        action: source.action,
    };

    callApi(updateSpecialtyProfessionalUrl,data).done((response)=>{
        $.event.trigger('handle-api-response', [{response:response}]);
    })

}
