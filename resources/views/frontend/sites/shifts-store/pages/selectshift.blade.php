@extends('frontend.sites.shifts-store.layout')

@section('content')

    <section class="ftco-section ftco-pricing">
        <div class="container">
            <div class="row justify-content-center pb-3">
                <div class="col-md-10 heading-section text-center ftco-animate">
                    <span class="subheading">Proximos turnos para el {{$shifts->first()->selected_date}}</span>
                    <h2 class="mb-4">Turnos</h2>
                    <p>Elige el horario que mas comodo te quede, nosotros nos acomodamos a vos!</p>
                </div>
            </div>
            <div class="row">
                @foreach($shifts as $key => $shift)
                <div class="col-md-3 ftco-animate mt-5 mb-5">
                    <div class="pricing-entry pb-5 text-center">
                        <div>

                            <h3 class="mb-4">En {{$shift->days_remain}} dias</h3>
                            <p><span class="price" id="selected_service_{{$key}}"
                                     data-key="{{$shift->service->id}}">{{$shift->service->name}}</span></p>
                        </div>
                        <ul>
                            <li>{{$shift->professional_name}} {{$shift->professional_last_name}}</li>
                            <li>
                                <p>{{$shift->attention_place->name}}</p>
                                <span>{{$shift->attention_place->address}}</span>
                                <span class="m-2">{{$shift->attention_place->number}}</span>
                            </li>
                            <li id="selected_date_{{$key}}">{{$shift->selected_date}}</li>
                            <li id="selected_hour_{{$key}}">{{$shift->hour}}</li>
                        </ul>
                        <p class="button text-center"><a id="{{$key}}" class="btn btn-primary px-4 py-3 reservHandler">Reservar</a></p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection


@section('custom-scripts')
    <script>

        const reserveShift = "{{route('frontend.reserve.shift')}}";
        const clientId = "{{Auth::user()->id}}";
        const redirectAfterSuccess = "{{route('frontend.profile')}}"
        $(document).ready(()=>{

            $('.nav').addClass('navbar-dark')
            $('.reservHandler').on('click', function(){
                let me = $(this).attr('id')
                let hour = $('#selected_hour_'+me).text();
                let date = $('#selected_date_'+me).text();
                let service = $('#selected_service_'+me).data('key');

                const params = {
                    hour: hour,
                    date: date,
                    service_id:service
                }
                callApi(reserveShift, params).then((response)=>{
                    if(response.error === true){
                        toastr.error('En estos momentos no podemos dar turnos.')
                    }else{
                        window.location.href = redirectAfterSuccess;
                    }
                })
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
        })
    </script>
@endsection


@section('custom-styles')
    <style>
        .nav-link {
            color:black!important;
        }
    </style>
@endsection

