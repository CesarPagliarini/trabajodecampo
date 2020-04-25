if (typeof (ScheduleModule) === 'undefined') ScheduleModule = {};

ScheduleModule = (function ($) {

    const attributes = {
        professional : {},
        specialties : {},
        attentionCenters: [],
        dateSelected: {}
    }
    let objectToSend = {};

    //inputs
    const schedulespecialtySelect = $(".schedules_specialty_select");
    const tabListener = $('#schedule_tab_listener');
    const attentionPlaceSelect = $(".schedules_attention_place_select");
    const scheduleInterval = $('#schedule_range .input-daterange');
    const dayOfTheWeeks = $('#schedule_day_select');
    const formWizard = $('#professional-schedules-wrapper');
    const buttonNoConfig = $('#alert_no_config');
    const settingListener = $('#setting_tab_listener');
    const morningTimeFrom = $('#morning_from');
    const morningTimeTo = $('#morning_to');
    const afternoonTimeFrom = $('#afternoon_from');
    const afternoonTimeTo = $('#afternoon_to');
    const fullTimeFrom = $('#full_time_from');
    const fullTimeTo = $('#full_time_to');
    const formSubmitHandler = $('#save_schedules');

    const addButtonHandler = $('#add_schedule_button');
    const addButtonIcon = $('#schedule_button_icon');
    const formWrapper = $('#schedlue_form_wrapper')

    const cancelButtonHandler = $('#cancel_schedules');



    const dateTo = $('#date_to');
    const dateFrom = $('#date_from');

    //configs
    const morningConfig = {
        timeFormat: 'HH:mm',
        interval: 15,
        minTime: '01',
        maxTime: '13:59pm',
        startTime: '01:00',
        maxMinutes:15,
        dynamic: false,
        dropdown: true,
        scrollbar: false,
        change: function(time) { resolveTime($(this))}
    }
    const afternoonConfig = {
        timeFormat: 'HH:mm',
        interval: 15,
        minTime: '14:00pm',
        maxTime: '23:59pm',
        maxMinutes:15,
        startTime: '12:00pm',
        dynamic: false,
        dropdown: true,
        scrollbar: false,
        change: function(time) { resolveTime($(this))}
    }

    //publishers
    const init = function () {
        formWizard.bind('checkConfigs', checkConfig);
        $.when(refreshConfigs()).done(()=>{
            schedulespecialtySelect.select2({width: '100%'});
            attentionPlaceSelect.select2({width: '100%'});
            dayOfTheWeeks.select2({width: '100%',    placeholder: "Selecciona los dias",});
            morningTimeFrom.timepicker(morningConfig)
            morningTimeTo.timepicker(morningConfig)
            afternoonTimeFrom.timepicker(afternoonConfig)
            afternoonTimeTo.timepicker(afternoonConfig)
            fullTimeFrom.timepicker(morningConfig)
            fullTimeTo.timepicker(afternoonConfig)


            scheduleInterval.datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                startDate:new Date(),
                format:'d/mm/yyyy'

            });
            tabListener.on('click', refreshConfigs);
            formSubmitHandler.on('click', submitForm);
            buttonNoConfig.on('click', () => {settingListener.click()})
            addButtonHandler.on('click', toggleForm)
            cancelButtonHandler.on('click', cancelForm)
        });

    };


    // suscribers
    attentionPlaceSelect.on('select2:select', function (e) { refreshSpecialties(e.params.data) });


    //metodos utiles
    const refreshConfigs = function(){
        callApi( professionalConfigs,{professional_id:professional.id})
            .then((response)=>{
                attributes.professional = response.data;
                const centers = response.data.map((item) =>{
                    item.attention_place['specialty_id'] = item.specialty.id;
                    return item.attention_place;
                });
                const distinctCenters = Array.from(new Set(centers.map(center => center.id))).map((id) => {
                    return centers.find(center => center.id === id);
                })
                attributes.attentionCenters = distinctCenters;

                attributes.specialties = response.data.map((item) =>{
                    item.specialty['attention_place_id'] = item.attention_place.id;
                    return item.specialty;
                });
                $('#professional-schedules-wrapper').removeClass('sk-loading')
                refreshCenters();
                formWizard.trigger('checkConfigs')
            })

    }
    const refreshCenters = function (){
        attentionPlaceSelect.clearSelect();
        attentionPlaceSelect.append(new Option('Seleccione una centro de atencion', '','selected'));
        attributes.attentionCenters.filter((center)=>{
            attentionPlaceSelect.append(new Option(center.name, center.id))
        })
    }
    const refreshSpecialties = function (data = {}){
        schedulespecialtySelect.clearSelect();
        const specialties = attributes.specialties.filter((spec) => {
            return spec.attention_place_id === parseInt(data.id)
        });
        const uniqueSpecialties = [];
        const map = new Map ();
        for (const item of specialties) {
            if (! map.has (item.id)) {
                map.set (item.id, true); // establece cualquier valor en Map
                uniqueSpecialties.push ({
                    id: item.id,
                    name: item.name
                });
            }
        }
        (uniqueSpecialties.length)
            ?  uniqueSpecialties.filter((spec)=>{
                schedulespecialtySelect.append(new Option(spec.name, spec.id))
            })
            : schedulespecialtySelect.append(new Option('Selecciona una especialidad', '', 'selected'))
    }
    const checkConfig = function(){
        console.log(attributes.professional.length)
        if(attributes.professional.length){
            formWizard.removeClass('hidden');
            buttonNoConfig.addClass('hidden')
            addButtonHandler.removeClass('hidden');
        }else {
            formWizard.addClass('hidden');
            buttonNoConfig.removeClass('hidden')
            addButtonHandler.addClass('hidden');
        }
    }
    const resolveTime = function(input){
        var element = input;
        const parent = element.data('parent');
        const child = element.data('child');
        const parentElement = (parent !== undefined) ? $('#'+parent) : null;
        const childElement = (child !== undefined) ? $('#'+child) : null;
        const errorHandler =   $('#error-'+element.data('error'));
        const selfValue = element.val();

        if(parentElement != null && parentElement.val() !== 'Apertura'){
            if(parentElement.val() >= selfValue){
                errorHandler.text('El horario de apertura no puede ser menor que el de cierre');
            }else{
                errorHandler.text('');
            }
        }
        if(childElement != null && childElement.val() !== 'Cierre'){
            if(childElement.val() <= selfValue){
                errorHandler.text('El horario de apertura no puede ser menor que el de cierre');
            }else{
                errorHandler.text('');
            }
        }
        const id = element.attr('id');


        if(id === 'full_time_from' || id === 'full_time_to'){
            morningTimeFrom.val('Apertura')
            morningTimeTo.val('Cierre')
            afternoonTimeFrom.val('Apertura')
            afternoonTimeTo.val('Cierre')
        }else{
            fullTimeFrom.val('Apertura')
            fullTimeTo.val('Cierre')
        }
    }

    const  callApi =  function(url, params = {}) {
        const token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': token}
        });
        return $.ajax({
            beforeSend:function() {
                $('#professional-schedules-wrapper').addClass('sk-loading')
            },
            type: "POST",
            url: url,
            data: params,
        })
    };
    const getSelectedScheduleTime = function (){
        const schedulesTimes = [
            {
                schedule:'morning',
                from:morningTimeFrom.val(),
                to:morningTimeTo.val(),
            },
            {
                schedule:'afternoon',
                from:afternoonTimeFrom.val(),
                to:afternoonTimeTo.val(),
            },
            {
                schedule:'fulltime',
                from:fullTimeFrom.val(),
                to:fullTimeTo.val(),
            },
        ];
        const selected = schedulesTimes.filter((schedule) => {
            if((schedule.from !== 'Apertura' && schedule.to !== 'Cierre') && ( schedule.from !== undefined && schedule.to !== undefined)){
                return schedule;
            }
        });
        return selected;
    };
    const buildFormData = function (){


        const days = dayOfTheWeeks.select2('data');
        const specialties  = schedulespecialtySelect.select2('data');
        const clearDays = days.map((day) => {return {id: day.id,day:day.text,}}) ;
        const clearSpecialties =specialties.map((spec) =>{return {id: spec.id}}) ;
        const times = getSelectedScheduleTime();
        const finalObj = {
            professional_id: professional.id,
            specialties:{
                value:JSON.stringify(clearSpecialties),
                selector:schedulespecialtySelect,
                required:true,
            },
            attention_place_id:{
                value: attentionPlaceSelect.find(':selected').val(),
                selector:attentionPlaceSelect,
                required:true,
            } ,
            from:{
                value:dateFrom.val(),
                selector:dateFrom,
                required:true,
            },
            to:{
                value:dateTo.val(),
                selector:dateTo,
                required:true,
            },
            days:{
                value:JSON.stringify(clearDays),
                required:true,
                selector:dayOfTheWeeks
            },
            morning_schedule:{},
            afternoon_schedule:{},
            run_schedule:{},
        };
        times.filter((time) => {
            if(time.schedule === 'morning'){
                finalObj.morning_schedule = time;
            }
            if(time.schedule === 'afternoon'){
                finalObj.afternoon_schedule = time;
            }
            if(time.schedule === 'fulltime'){
                finalObj.run_schedule = time;
            }
        });

        return finalObj;
    }
    const checkValidval = function (val){
        return (val !== undefined && val !== 'undefined' && val !== '');
    }
    const validateForm = function (){
        const form = buildFormData()
        let isValidForm = true;
        if( ! checkValidval(form.specialties.value) || form.specialties.value ==='[]') {
            $('#specialty_error').removeClass('hidden');
            isValidForm = false;
        }else{
            $('#specialty_error').addClass('hidden');
        }
        if( ! checkValidval(form.attention_place_id.value)) {
            $('#attention_place_error').removeClass('hidden');
            isValidForm = false;
        }else{
            $('#attention_place_error').addClass('hidden');
        }
        if( ! checkValidval(form.from.value) || ! checkValidval(form.to.value)) {
            $('#date_interval_error').removeClass('hidden');
            isValidForm = false;
        }else{
            $('#date_interval_error').addClass('hidden');
        }

        if( ! checkValidval(form.days.value) ||  form.days.value === '[]' ) {
            $('#schedule_days_error').removeClass('hidden');
            isValidForm = false;
        }else{
            $('#schedule_days_error').addClass('hidden');
        }
        let morn = (Object.getOwnPropertyNames(form.morning_schedule).length > 0);
        let afte = (Object.getOwnPropertyNames(form.afternoon_schedule).length > 0);
        let full = (Object.getOwnPropertyNames(form.run_schedule).length > 0);
        if( (!morn) && (!afte) && (!full)) {
            $('#time_error').removeClass('hidden');
            isValidForm = false;
        }else{
            $('#time_error').addClass('hidden');
        }


        if(isValidForm){
            objectToSend = {
                professional_id: professional.id,
                specialties_ids: form.specialties.value,
                attention_place_id: form.attention_place_id.value,
                from: form.from.value,
                to:form.to.value,
                days:form.days.value,
                morning_schedule:null,
                afternoon_schedule:null,
                run_schedule:null,
            }
            if(morn){
                let sched = form.morning_schedule.from + ',' + form.morning_schedule.to
                objectToSend.morning_schedule  = sched.trim();
            }
            if(afte){
                let sched = form.afternoon_schedule.from + ',' + form.afternoon_schedule.to
                objectToSend.afternoon_schedule = sched.trim();
            }
            if(full){
                let sched = form.run_schedule.from + ',' + form.run_schedule.to
                objectToSend.run_schedule  = sched.trim();
            }

        }
        return isValidForm;

    }

    const toggleForm = function (){
        addButtonIcon.toggleClass('fa-plus fa-minus');
        formWrapper.toggleClass('hidden');
    }

    const cancelForm = function(){
        $('#specialty_error').addClass('hidden');
        $('#attention_place_error').addClass('hidden');
        $('#date_interval_error').addClass('hidden');
        $('#schedule_days_error').addClass('hidden');
        $('#time_error').addClass('hidden');
        toggleForm();
    }

    const submitForm = function (){
        if(validateForm()){
            callApi(scheduleAddUrl, objectToSend).then((response)=>{
                console.log(response);
                if(response.error === true){
                    toastr.error(response.message);
                } else{
                    toastr.success(response.message);
                    window.location.reload();
                }
                $('#professional-schedules-wrapper').removeClass('sk-loading')
            });
        };
    }

    const getAttributes = function(){
        return attributes
    }
    // expose public methods
    return {
        init: init,
        attributes:getAttributes,
    };


})(jQuery);
jQuery(document).ready(ScheduleModule.init);
