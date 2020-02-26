<script>

    const newSpecialtySelect = $('.settings_specialty_select');
    const newServiceSelect = $('.settings_service_select');
    const newAttentionPlaceSelect = $(".settings_attentionPlace_select");
    const newTimeUnitSelect = $(".settings_time_unit_input");
    const newCurrencySelect = $(".settings_currency_select");
    const newWorkHolidaySelect = $('.work_holiday');
    const newShowAmountSelect = $('.show_amount');
    const newAmountSelect = $('#settings_amount_input');
    const newIsHighlightedSelect = $('.settings_is_highlighted');
    const newIsTemporal = $('.settings_is_temporal');
    const currentProfessionalId =JSON.parse(professional).id;

    data = {
        specialties:{},
        attentionPlaces:{},
        time_units:[],
    }

    switchers = [
        {element:document.querySelector('.settings_is_highlighted')},
        {element:document.querySelector('.settings_is_temporal')},
    ];



    $(document).ready(() =>{
        /**
        * starts script
        * */
        setExtends()
        startSwichs()


        /**
         * event bindings
         * */

        $(document).on("allowTimeUnits", checkAllowTimeUnits);
        $(document).on("refresh-specialties",currentProfessionalId, getProfessionalSpecialties);
        $('#save_settings').click(()=>{saveForm();});
        $('#cancel_settings').click(()=>{cancelForm();})
        $('.add-new-config').click(()=>{toggleForm();})
        newSpecialtySelect.select2({width: '100%'});
        newServiceSelect.select2({width: '100%'});
        newAttentionPlaceSelect.select2({width: '100%'});
        newCurrencySelect.select2({width: '100%'});

        newSpecialtySelect.on('select2:select', function (e) {
            let data = e.params.data;
            getSpecialtyServices(data.id)
        });
        newAttentionPlaceSelect.on('select2:select', function (e) {
            $.event.trigger({type:'allowTimeUnits'});
        });
        newServiceSelect.on('select2:select', function (e) {
            $.event.trigger({type:'allowTimeUnits'});
        });

        /**
         * Trigger events
         * */
        $(document).trigger('refresh-specialties');
        getCurrencies()
        getAttentionPlaces()

    })



    /***getters*/
    function getSpecialtyServices(specialty_id){
        callApi(specialtyServicesUrl,{specialty_id :specialty_id }).then((response) => {
            newServiceSelect.clearSelect()
            if(!response.length){
                (response.length)
                ? newServiceSelect.append(new Option('Selecciona primero una especialidad'))
                : newServiceSelect.append(new Option('Esa especialidad no tiene servicios aun'));

            }else{
                response.filter((item) => {
                    newServiceSelect.append(new Option(item.name, item.id))
                });
            }
            $('#professional-settings-wrapper').removeClass('sk-loading')
            $.event.trigger({type:'allowTimeUnits'});
        });


    }
    function getProfessionalSpecialties(e){
        callApi(professionalSpecialtiesUrl,{professional_id :e.data }).then((response) => {
            data.specialties = response;
            response.filter((item) => {
                newSpecialtySelect.append(new Option(item.name, item.id))
            });
            $('#professional-settings-wrapper').removeClass('sk-loading')
        });
    }
    function getCurrencies(){

        callApi(getCurrenciesUrl).then((response) => {
            data.currencies = response;
            response.filter((item) => {
                newCurrencySelect.append(new Option(item.name, item.id))
            });
            $('#professional-settings-wrapper').removeClass('sk-loading')
        });
    }
    function getAttentionPlaces(){
        callApi(attentionCentersUrl).then((response) => {
            data.attentionPlaces = response
            response.filter((item) => {
                newAttentionPlaceSelect.append(new Option(item.name, item.id))
            });
        });
        $(document).trigger('allowTimeUnits');
    }
    function getCurrentInputs(){
        return [
            {
                control:"especialty_id",
                input: newSpecialtySelect,
                value: newSpecialtySelect.find(':selected').val(),
            },
            {
                control:"service_id",
                input:newServiceSelect,
                value:newServiceSelect.find(':selected').val(),
            },
            {
                control:"attention_place_id",
                input:newAttentionPlaceSelect,
                value:newAttentionPlaceSelect.find(':selected').val(),
            },
            {
                control:"unit_time",
                input:newTimeUnitSelect,
                value:newTimeUnitSelect.find(':selected').val(),
            },
            {
                control:"work_holiday",
                input:newWorkHolidaySelect,
                value:newWorkHolidaySelect.val(),
            },
            {
                control:"show_amount",
                input:newShowAmountSelect,
                value:newShowAmountSelect.val(),
            },
            {
                control:"currency_id",
                input:newCurrencySelect,
                value:newCurrencySelect.find(':selected').val(),
            },
            {
                control:"amount",
                input:newAmountSelect,
                value:newAmountSelect.val(),
            },
            {
                control:"is_highlighted",
                input:newIsHighlightedSelect,
                value:newIsHighlightedSelect.is(':checked'),
            },{
                control:"is_temporal",
                input:newIsTemporal,
                value:newIsTemporal.is(':checked'),
            },
        ]
    }



    /**setters and behavoirals*/
    function setUnitTimeIntervals(){
        const intervals = [];

        for (let i = 0 ; i < 24 ; i++ ) {

            for (let f = 1; f < 4; f++) {

                let standar_unit = 15

                let minutos = standar_unit * f;

                let units = (((i * 60) + minutos) / standar_unit)

                let stringHour = (i === 1) ? 'hora' : 'horas';

                intervals.push({
                    id: parseInt(units),
                    text: `${i} ${stringHour} : ${minutos} minutos`
                })
            }
        }
        data.time_units = intervals;
    }
    function checkAllowTimeUnits(){

        let message = 'Selecciona un tiempo estimado';
        let isValid = false;
        let especialidad = newSpecialtySelect.find(':selected').val();
        let servicio = newServiceSelect.find(':selected').val();
        let centroAtencion = newAttentionPlaceSelect.find(':selected').val();

        if(especialidad === '')
        {
            message = "Selecciona una especialidad primero";
        }
        else if(servicio === '')
        {
            message = "Selecciona un servicio primero";
        }
        else if(centroAtencion === '')
        {
            message = "Selecciona un centro de atencion primero";
        }
        else{
            message = "Selecciona un tiempo estimado";
            isValid = true
        }

        if(isValid){

            $.when(setUnitTimeIntervals()).done(() =>{
                newTimeUnitSelect.clearSelect()
                newTimeUnitSelect.select2({
                    width: '100%',
                    data: data.time_units
                });

            });
        }else{
            newTimeUnitSelect.select2({width: '100%'});
            newTimeUnitSelect.clearSelect()
            newTimeUnitSelect.append(new Option(message, '','selected'))
        }
    }
    function validateForm(){
        let inputs = getCurrentInputs();
        const validInputs = [];
        const inValidInputs = [];
        inputs.filter((input) => {
            let is_undefined = (input.value === undefined || input.value==='undefined');
            let is_empty = (input.value ==='');
            let is_null = (input.value === null);
            (is_empty ||is_null|| is_undefined)
            ? inValidInputs.push(input)
            : validInputs.push(input);
        });

        showErrors(inValidInputs, validInputs)

        return ( ! inValidInputs.length);
    }

    function showErrors(invalidInputs, validInputs){
        if(invalidInputs.length){
            invalidInputs.filter((input) => {
                (input.control ==='amount')
                    ? $('#settings_amount_input_label').addClass('bg-danger')
                    : input.input.parent().parent().find('.col-form-label').addClass('bg-danger')
            });
            $('#settings-alert-span').removeClass('hidden');
        }
        validInputs.filter((input)=>{
            (input.control ==='amount')
                ? $('#settings_amount_input_label').removeClass('bg-danger')
                : input.input.parent().parent().find('.col-form-label').removeClass('bg-danger')
        });
        let allInputs = invalidInputs.length + validInputs.length;
        (allInputs.length === validInputs.length && ! validInputs.length)
        {
            $('#settings-alert-span').addClass('hidden');
        }
        return;
    }


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
    function saveForm(){
        params = {
            professional_id: JSON.parse(professional).id,
            specialty_id: newSpecialtySelect.find(':selected').val(),
            service_id:newServiceSelect.find(':selected').val(),
            attention_place_id:newAttentionPlaceSelect.find(':selected').val(),
            time_unit:newTimeUnitSelect.find(':selected').val(),
            work_holiday:newWorkHolidaySelect.val(),
            show_amount:newShowAmountSelect.val(),
            currency_id:newCurrencySelect.find(':selected').val(),
            amount:newAmountSelect.val(),
            is_highlighted:newIsHighlightedSelect.is(':checked'),
            is_temporal:newIsTemporal.is(':checked'),
        };
        if(validateForm()){
            callApi(addSettingsRoute, params).then((response) => {
                $('#professional-settings-wrapper').removeClass('sk-loading')
            })
        };
    }
    function cancelForm(){
        newSpecialtySelect.val('').trigger('change');
        newServiceSelect.val('').trigger('change');
        newAttentionPlaceSelect.val('').trigger('change');
        newTimeUnitSelect.val('').trigger('change');
        newCurrencySelect.val('').trigger('change');
        newWorkHolidaySelect.val('').trigger('change');
        newShowAmountSelect.val('').trigger('change');
        newServiceSelect.append(new Option('Selecciona primero una especialidad','','selected')).trigger('change');
        toggleForm();
    }
    function toggleForm(){
        $('#new-config-container').toggleClass('hidden');
        $('#icon-add-new-config').toggleClass('fa fa-plus fa fa-minus')
    }
    function setExtends(){
        jQuery.fn.extend({
            clearSelect: function() {
                return this.children().remove()
            },
        });
    }
    function startSwichs(){
        switchers.filter(function (el){
            new Switchery(el.element, { color: '#1AB394' });
        })

    }


</script>
