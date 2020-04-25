@extends('layouts.content-panel')
@section('page-name')
    Calendario de turnos
@endsection
@section('content')
    <div class="ibox-content">
        <div id='calendar'></div>
    </div>
@endsection

@section('custom-styles')

    <link rel="stylesheet" href="{{asset('css/fullcalendar/fullcalendar.css')}}">
@endsection
@include('backend.modals.show-event-calendar')
@section('custom-scripts')




<script src="{{asset('js/fullcalendar/moment.min.js')}}"></script>
<script src="{{asset('js/fullcalendar/fullcalendar.js')}}"></script>
<script src="{{asset('js/fullcalendar/locale-all.js')}}"></script>



    <script>

        const events = @json($data);
        $(document).ready(()=>{
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                locale:'es',
                eventRender: function(event, element) {
                    element.css("font-size", "1em");
                    element.css("padding", "1px");
                },
                eventClick: function(info) {
                    const start = moment(info.start).format('h:mm:ss a')
                    const end = moment(info.end).format('h:mm:ss a')
                    const registerAt = moment(info.registered_at).format('h:mm:ss a')
                    console.log(info);
                    $('#service_modal').text('')
                    $('#attention_place_modal').text('')
                    $('#client_modal').text('')
                    $('#start_modal').text('')
                    $('#end_modal').text('')
                    $('#register_at').text('')
                    const attention_place = info.attention_place+' '+ info.attention_place_address+' '+info.attention_place_number;
                    $('#service_modal').text(info.title)
                    $('#registered_at').text(registerAt)
                    $('#attention_place_modal').text(attention_place)
                    $('#client_modal').text(info.client)
                    $('#start_modal').text(start)
                    $('#end_modal').text(end)
                    $('#event-calendar').modal();

                },



                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar
                drop: function() {
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },
                timeFormat: 'H(:mm)' // uppercase H for 24-hour clock

            });

            renderEvents()
        });

        function renderEvents(){
            const source = events;
            $("#calendar").fullCalendar( 'addEventSource', source )
        }


    </script>
@endsection


{{--$(function() {--}}
{{--$('#calendar').fullCalendar({--}}
{{--schedulerLicenseKey : 'GPL-My-Project-Is-Open-Source',--}}
{{--editable : true,--}}
{{--scrollTime : '00:00',--}}
{{--defaultDate : '2018-01-02',--}}
{{--defaultView : 'timelineDay',--}}
{{--resourceLabelText : 'Rooms',--}}
{{--resources : [ {--}}
{{--id : 'R1',--}}
{{--title : 'Room 1'--}}
{{--} ],--}}
{{--events : [ {--}}
{{--id : '1',--}}
{{--resourceId : 'R1',--}}
{{--start : '2018-01-02T02:00:00',--}}
{{--end : '2018-01-02T07:00:00',--}}
{{--title : 'First event'--}}
{{--} ]--}}
{{--});--}}
{{--});--}}
