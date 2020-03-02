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
@section('custom-scripts')




<script src="{{asset('js/fullcalendar/moment.min.js')}}"></script>
<script src="{{asset('js/fullcalendar/fullcalendar.js')}}"></script>
<script src="{{asset('js/fullcalendar/locale-all.js')}}"></script>



    <script>
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
                    console.log(start);
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

        });

        function renderEvents(){

            const source = [
                {
                    title:  'corte de pelo',
                    start:  '2020-03-02T14:00:00',
                    end: '2020-03-02T14:15:00',
                    allDay: false
                },
                {
                    title:  'tira de cola',
                    start:  '2020-03-02T14:15:00',
                    end: '2020-03-02T15:30:00',
                    allDay: false
                },
                {
                    title:  'corte de pelo',
                    start:  '2020-03-04T18:30:00',
                    end: '2020-03-02T19:00:00',
                    allDay: false
                },
            ];
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
