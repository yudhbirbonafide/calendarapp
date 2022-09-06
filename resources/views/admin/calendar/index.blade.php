@extends('layouts.admin')
@section('content')
<script src="{{asset('calendar/main.js')}}"></script>
<link rel="stylesheet" href="{{asset('calendar/main.css')}}">
 <!-- [ Main Content ] start -->
 <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!--[ daily sales section ] start-->
                                <div class="col-md-12">
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4">Daily Sales</h6>
                                            <div id='calendar'></div>

                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridDay,timeGridWeek,dayGridMonth,listDay,listWeek,listMonth,listYear'
            },
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            businessHours: true, 
            selectable: true,
            weekNumbers: true,
            weekNumberCalculation: 'ISO',
            showNonCurrentDates: false,// will disable the non current month days
            dayMaxEvents: true, // allow "more" link when too many events
            views: {            
                timeGridDay: { buttonText: 'Day' },
                timeGridWeek: { buttonText: 'week' },
                dayGridMonth: { buttonText: 'Month' },                
                listDay: { buttonText: 'List Day' },
                listWeek: { buttonText: 'List Week' },
                listMonth: { buttonText: 'List Month' },
                listYear: { buttonText: 'List Year' },
            },
            displayEventTime: false, 
            eventClick: function(arg) {
                // opens events in a popup window
                window.open(arg.event.url, 'google-calendar-event', 'width=700,height=600');
                // if (confirm('Are you sure you want to delete this event?')) {
                //     arg.event.remove()
                // }

                arg.jsEvent.preventDefault() // don't navigate in main tab
            },
            loading: function(bool) {
                // document.getElementById('loading').style.display = bool ? 'block' : 'none';
            },
            select: function(arg) {
                var title = prompt('Event Title:');
                if (title) {
                calendar.addEvent({
                    title: title,
                    start: arg.start,
                    end: arg.end,
                    allDay: arg.allDay
                })
                }
                calendar.unselect()
            },
            events: [
                {
                title: 'All Day Event',
                start: '2022-09-01'
                },
                {
                title: 'Long Event',
                start: '2022-09-07',
                end: '2022-09-10'
                },
                {
                groupId: 999,
                title: 'Repeating Event',
                start: '2022-09-09T16:00:00'
                },
                {
                groupId: 999,
                title: 'Repeating Event',
                start: '2022-09-16T16:00:00'
                },
                {
                title: 'Conference',
                start: '2022-09-11',
                end: '2022-09-13'
                },
                {
                title: 'Meeting',
                start: '2022-09-12T10:30:00',
                end: '2022-09-12T12:30:00'
                },
                {
                title: 'Lunch',
                start: '2022-09-12T12:00:00'
                },
                {
                title: 'Meeting',
                start: '2022-09-12T14:30:00'
                },
                {
                title: 'Happy Hour',
                start: '2022-09-12T17:30:00'
                },
                {
                title: 'Dinner',
                start: '2022-09-12T20:00:00'
                },
                {
                title: 'Birthday Party',
                start: '2022-09-13T07:00:00'
                },
                {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2022-09-28'
                }
            ]

        });

        calendar.render();
    });
    </script>
    <style>
        .fc .fc-button-group > .fc-button {
            position: relative;
            flex: 1 1 auto;
            margin-right: 2px;
        }
    </style>
    <!-- [ Main Content ] end -->
    @endsection