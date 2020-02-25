<script>

    const newSpecialtySelect = $('.settings_specialty_select');
    const newServiceSelect = $('.settings_service_select');
    $(document).ready(() => {

        newSpecialtySelect.select2({width: '100%'});
        newServiceSelect.select2({width: '100%'});

        getProfessionalSpecialties(JSON.parse(professional).id)
    })

    let professionalSpecialties;


    newSpecialtySelect.on('select2:select', function (e) {
        let data = e.params.data;
        getSpecialtyServices(data.id)
    });

    function getSpecialtyServices(specialty_id)
    {
        const token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': token}
        });
        $.ajax({
            beforeSend:function() {
                $('#professional-settings-wrapper').addClass('sk-loading')
            },
            type: "POST",
            url: specialtyServicesUrl,
            data: {specialty_id :specialty_id },
            success:  function (response) {
                console.log(response)
                response.filter((item) => {
                    newServiceSelect.append(new Option(item.name, item.id))
                    console.log(item.id);
                });
                $('#professional-settings-wrapper').removeClass('sk-loading')
            }
        });
    }
    function getProfessionalSpecialties(id)
    {
        const token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': token}
        });
        $.ajax({
            beforeSend:function() {
                $('#professional-settings-wrapper').addClass('sk-loading')
            },
            type: "POST",
            url: professionalSpecialtiesUrl,
            data: {professional_id :id },
            success:  function (response) {
                console.log(response)
                specialties = response;
                response.filter((item) => {
                    newSpecialtySelect.append(new Option(item.name, item.id))
                    console.log(item.id);

                });
                $('#professional-settings-wrapper').removeClass('sk-loading')
            }
        });
    }
</script>
