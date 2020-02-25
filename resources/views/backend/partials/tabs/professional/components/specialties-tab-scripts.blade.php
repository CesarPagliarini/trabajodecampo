<script>
    $(document).ready(function(){
        $(".specialties_professional_select").select2({width: '100%'});
    });


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

    function updateProfessionalSpecialties(source){
        const token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': token}
        });
        source.professional_id = JSON.parse(professional).id;

        $.ajax({
            beforeSend:function() {
                $('#professional_specialty_wrapper').addClass('sk-loading')
            },
            type: "POST",
            url: specialtyurl,
            data: source,
            success:  function (response) {
                $('#professional_specialty_wrapper').removeClass('sk-loading')
            }
        });

    }
</script>
