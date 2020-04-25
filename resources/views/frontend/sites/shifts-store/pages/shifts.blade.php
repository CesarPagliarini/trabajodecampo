@extends('frontend.sites.shifts-store.layout')

@section('content')

<section class="ftco-section ftco-pricing">
    <div class="container">
        <div class="row justify-content-center pb-3">
            <div class="col-md-10 heading-section text-center ftco-animate">
                <span class="subheading">Solicitar</span>
                <h2 class="mb-4">Turnos</h2>
                <p>Agenda aqui tu proxima visita! </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10 ftco-animate fadeInUp ftco-animated">
                <form action="#" class="appointment-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="" id="attention_place_handdler" class="form-control">
                                        <option value="" disabled selected>Selecciona un centro de atencion</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="" id="specialty_handdler" class="form-control">
                                        <option value="" disabled selected>Selecciona una especialidad</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="" id="services_handdler" class="form-control">
                                        <option value="" disabled selected>Selecciona un servicio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row align-content-center">
                    <div class="col-sm-12">
                        <div class="row" id="calendar-handdler">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('custom-scripts')
    <script>

        const data = {
            attention_places: [],
            specialties: [],
            services: [],
            scheduleDates: [],
            scheduleSelected:''
        }

        const inputs = {
            attentionPlaces :$('#attention_place_handdler'),
            specialty :$('#specialty_handdler'),
            services : $('#services_handdler')
        }
        const calendarHanddler = $('#calendar-handdler');

        const attentionCenterUrl = "{{route('frontend.attention.places')}}"
        const specialtiesForAttentionCenter = "{{route('frontend.specialties.for.attention.place')}}"
        const servicesForSecialty = "{{route('frontend.services.for.specialty')}}"
        const aviableSchedules = "{{route('frontend.aviable.schedules')}}"
        const getShifts = "{{route('frontend.get.shifts')}}"

        $(document).ready(()=>{

            calendarHanddler.empty()
            $(document).on('get_aviable_schedules',getAviableSchedules);
            callApi(attentionCenterUrl).then((response)=>{
                data.attention_places =response;
                appendAttentionPlaces();
            });
            inputs.attentionPlaces.change((e)=>{
                calendarHanddler.empty()
                const params = { attention_place_id : inputs.attentionPlaces.find(':selected').val() } ;
                callApi(specialtiesForAttentionCenter, params).then((response)=>{
                    data.specialties = response;
                    appendSpecialties();
                });
            });

            inputs.specialty.change((e)=>{
                calendarHanddler.empty()
                const params = {specialty_id : inputs.specialty.find(':selected').val()};
                callApi(servicesForSecialty, params).then((response)=>{
                    data.services = response;
                    appendServices();

                });
            });
            inputs.services.change(()=>{
                calendarHanddler.empty()
                $(document).trigger('get_aviable_schedules');
            })


            $(document).on('click', '.scheduleSelector', function(){
                const selected = { id: $(this).attr('id') };
                data.scheduleSelected = selected.id
                params = {
                    schedule_id : data.scheduleSelected,
                    service_id: inputs.services.find(':selected').val(),
                    attention_place_id:inputs.attentionPlaces.find(':selected').val(),
                    specialty_id:inputs.specialty.find(':selected').val(),
                };
                callApi(getShifts,params).done((response) => {
                    console.log(response);
                    if(response.error === undefined || response.error ==='undefined' || response.error === true)
                    {
                        toastr.error(response.message);
                    }else{
                        window.location.href = response.data;
                    }

                });

            });

        });

        const  callApi =  function(url, params = {}) {
            const token = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': token}
            });
            return $.ajax({
                beforeSend:function() {
                },
                type: "POST",
                url: url,
                data: params,
            })
        };

        function appendAttentionPlaces(){

            data.attention_places.filter((attentionPlace)=>{

                inputs.attentionPlaces.append(`<option value="${attentionPlace.id}">${attentionPlace.name}</option>`)
            })
        }
        function appendSpecialties(){

            data.specialties.filter((specialty)=>{

                inputs.specialty.append(`<option value="${specialty.id}">${specialty.name}</option>`)
            })
        }
        function appendServices(){
            data.services.filter((service)=>{
                inputs.services.append(`<option value="${service.id}">${service.name}</option>`)
            });
        }

        function handleModal()
        {
            $('#shiftsModal').modal();
        }

        function getAviableSchedules(){

           const params = {
                attention_place_id: inputs.attentionPlaces.val(),
                specialty_id: inputs.specialty.val(),
                service_id: inputs.services.val()
            }
            callApi(aviableSchedules,params).done((response)=>{
                calendarHanddler.empty()
                data.scheduleDates = response;
                data.scheduleDates.filter((scheduleDate) => {
                    calendarHanddler.append(`
                        <div class="col-md-2 scheduleSelector" id="${scheduleDate.schedule_id}">
                            <time class="icon">
                                <em>${scheduleDate.week_day}</em>
                                <strong>${scheduleDate.month}</strong>
                                <span>${scheduleDate.day_number}</span>
                            </time>
                        </div>
                    `)
                })
            });
        }

    </script>
@endsection


@section('custom-styles')
    <link rel="stylesheet" href="{{asset('sites/shifts-store/css/calendar-widget.css')}}">
    <style>
        .nav-link {
            color:black!important;
        }
    </style>
@endsection

