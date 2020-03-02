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
const currentProfessionalId =professional.id;
const modalShureDelete = $('#professional-settings-delete-modal')
const table = $('#settings-table-body');
const settingTabListener = $('#setting_tab_listener');
const data = {
    specialties:{},
    attentionPlaces:{},
    time_units:[],
    lastConfig:{},
}
const switchers = [
    {element:document.querySelector('.settings_is_highlighted')},
    {element:document.querySelector('.settings_is_temporal')},
];

const barreda = {
    victim:{id:''},
    setVictim : function (data) { this.victim.id = data.id },
    hideVictim : function() { this.victim.id = ''},
    killWife : function (){
        let victim = this.victim;
        $.event.trigger('remove-row-item',[{id:victim.id}])
    },
    suspect: function() { return this.victim.id === ''}
};

// function showModal(data){
//
// };

$(document).ready(() =>{


    /**
     * starts script
     * */
    setExtends()
    startSwichs()


    /**
     * event bindings
     * */

    $('.settings-table').footable();

    $(document).on("allowTimeUnits", checkAllowTimeUnits);
    $(document).on("refresh-specialties",currentProfessionalId, getProfessionalSpecialties);
    $(document).on("handle-api-response", handleApiErrors);
    $(document).on("append-to-table", appendToTable);
    $(document).on("remove-row-item", removeThisItem);

    $(document).on("generate-table", generateTable);
    settingTabListener.on('click', () => {$.event.trigger('refresh-specialties')})





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
    $.event.trigger('refresh-specialties')

        $.when(getConfigs()).done(()=>{
            setUnitTimeIntervals()
            $.event.trigger('generate-table')
        });
    getCurrencies()

    getAttentionPlaces()

    $(document).on('click', '.buttonKiller', function(){
        const data = { id: $(this).attr('id') };
        barreda.setVictim(data);
        modalShureDelete.modal();
    });

});

$(document).on('click', '#modal-delete-setting', () => {
    if( ! barreda.suspect() ){
        barreda.killWife();
        barreda.hideVictim();
    }
    modalShureDelete.modal('hide');
    return false;
});

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
        newSpecialtySelect.clearSelect();
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
            const selected = (item.id === 1);
            newCurrencySelect.append(new Option(item.name, item.id, true,true)).trigger('change');
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
            label: 'Especialidad'
        },
        {
            control:"service_id",
            input:newServiceSelect,
            value:newServiceSelect.find(':selected').val(),
            label: 'Servicio'
        },
        {
            control:"attention_place_id",
            input:newAttentionPlaceSelect,
            value:newAttentionPlaceSelect.find(':selected').val(),
            label: 'Centro de atencion',
        },
        {
            control:"unit_time",
            input:newTimeUnitSelect,
            value:newTimeUnitSelect.find(':selected').val(),
            label: 'Tiempo estimado',
        },
        {
            control:"work_holiday",
            input:newWorkHolidaySelect,
            value:newWorkHolidaySelect.val(),
            label: 'Trabaja domingos y feriados',
        },
        {
            control:"show_amount",
            input:newShowAmountSelect,
            value:newShowAmountSelect.val(),
            label: 'Muestra precio en web',
        },
        {
            control:"currency_id",
            input:newCurrencySelect,
            value:newCurrencySelect.find(':selected').val(),
            label: 'Moneda',

        },
        {
            control:"amount",
            input:newAmountSelect,
            value:newAmountSelect.val(),
            label: 'Costo promedio',
        },
        {
            control:"is_highlighted",
            input:newIsHighlightedSelect,
            value:newIsHighlightedSelect.is(':checked'),
            label: 'Destacada',
        },{
            control:"is_temporal",
            input:newIsTemporal,
            value:newIsTemporal.is(':checked'),
            label: 'Actividad temporal',
        },
    ]
}
/**setters and behavoirals*/
function setUnitTimeIntervals(){

    let intervals = [];

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
    if(allInputs === validInputs.length)
    {

        $('#settings-alert-span').addClass('hidden');
    }
}
function handleApiErrors(event, data){
    let response = data.response;
    if(response.error === 'true'){
        toastr.error(response.message);
    }else{
        toastr.success(response.message);
    }
    $('#professional-settings-wrapper').removeClass('sk-loading')
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
    const params = {
        professional_id: professional.id,
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
            console.log(response);
            $.event.trigger('handle-api-response', [{response:response}]);
            if(response.error === "false"){

                $.when($.event.trigger('append-to-table', [{id:response.itemId}])).done(()=>{
                    cancelForm();
                });
            }
        })
    }
}
function cancelForm(){
    newSpecialtySelect.val('').trigger('change');
    newServiceSelect.clearSelect();
    newAttentionPlaceSelect.val('').trigger('change');
    newTimeUnitSelect.val('').trigger('change');
    newCurrencySelect.val('').trigger('change');
    newAmountSelect.val('').trigger('change');

    newTimeUnitSelect.clearSelect()
    newTimeUnitSelect.append(new Option('Selecciona primero una especialidad', '','selected'))
    newServiceSelect.append(new Option('Selecciona primero una especialidad','','selected')).trigger('change');

    let inputs = getCurrentInputs()
    showErrors([], getCurrentInputs());

    toggleForm();
}
function toggleForm(){
    $('#new-config-container').toggleClass('hidden');
    $('#icon-add-new-config').toggleClass('fa fa-plus fa fa-minus')
}
function setExtends(){
    jQuery.fn.extend({
        clearSelect: function() {
            this.children().remove()
            return this;
        },
    });
}
function startSwichs(){
    switchers.filter(function (el){
        new Switchery(el.element, { color: '#1AB394' });
    })

}
function appendToTable(event, params){
    let insertedId = params.id;
    let inputs = getCurrentInputs();
    let newRow = {}

    inputs.filter((item)=>{

        if(item.input.is('select'))
        {
            let name = item.control;
            let value = item.value
            let label = item.label
            let text = item.input.find(':selected').text();
            newRow[name]  = {name:name,value:value, label:label, text:text};
        }else{
            let name = item.control;
            let value = item.value;
            let label = item.label;
            let text = onCheckHtml(value);

            newRow[name]  = {name:name,value:value, label:label, text:text};
        }

    });
    addRow(newRow, insertedId);
}
function onCheckHtml(value){
    if(value === '' || value === 'undefined' || value === undefined || value > 1) return value;
    if( value === 1 || value === true){
        return `<button class="btn btn-default" type="button"><i class="fa fa-thumbs-o-up"></i></button>`
    }else{
        return `<button class="btn btn-default" type="button"><i class="fa fa-thumbs-o-down"></i></button>`
    }
}

function removeThisItem(event, data){
    callApi(removeRoute,{id:data.id}).done((response)=>{
        if(response.error === 'false'){
            $.when($('#row-'+data.id).remove()).done(()=>{
                $('.settings-table').trigger('footable_redraw');
            });
        }
        $.event.trigger('handle-api-response', [{response:response}]);
    })
}
function addRow(row, insertedId){
    table.prepend(`
            <tr id='row-${insertedId}'>
                <td>${row.especialty_id.text}</td>
                <td>${row.service_id.text}</td>
                <td>${row.attention_place_id.text}</td>
                <td>${row.unit_time.text}</td>
                <td>${row.currency_id.text} ${row.amount.value}</td>
                <td>${row.work_holiday.text}</td>
                <td>${row.show_amount.text}</td>
                <td>${row.is_highlighted.text}</td>
                <td>
                    <button type='button' class='btn btn-primary btn-xs full-width'   >
                        Editar
                    </button>
                    <button type='button' class='btn btn-danger btn-xs full-width buttonKiller'  id='${insertedId}'>
                        Eliminar
                    </button>
                </td>
            </tr>
        `);
    $('.settings-table').trigger('footable_redraw');
}
async function getConfigs(){
    await callApi(professionalConfigs, {professional_id:currentProfessionalId}).done((response) => {
        if(response.error === 'true'){
            $.event.trigger('handle-api-response', [{response:response}]);
        }
        data.lastConfigs = response.data;
    })
}
function generateTable(){

    const inputs = getCurrentInputs();
    const intervals = data.time_units;
    data.lastConfigs.filter((config) => {
        config.time_unit = intervals.find(id => config.time_unit).text;
        console.log(config.time_unit)
        config.show_amount = onCheckHtml(config.show_amount);
        config.work_holiday = onCheckHtml(config.work_holiday);
        config.is_highlighted = onCheckHtml(config.is_highlighted);
        table.prepend(`
                 <tr id='row-${config.line}'>
                     <td>${config.specialty.name}</td>
                     <td>${config.service.name}</td>
                     <td>${config.attention_place.name}</td>
                     <td>${config.time_unit}</td>
                     <td>${config.currency.name} ${config.amount}</td>
                     <td>${config.work_holiday}</td>
                     <td>${config.show_amount}</td>
                     <td>${config.is_highlighted}</td>
                     <td>
                         <button type='button' class='btn btn-primary btn-xs full-width'   >
                             Editar
                         </button>
                         <button type='button' class='btn btn-danger btn-xs full-width buttonKiller'  id='${config.line}'>
                             Eliminar
                         </button>
                     </td>
                 </tr>
             `);
        $('.settings-table').trigger('footable_redraw');
    });




}
