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
            right: 'dayGrid,dayGridDay,dayGridWeek,dayGridMonth,list,listDay,listWeek,listMonth,listYear'
        },
        views: {
            listDay: { buttonText: 'List Day' },
            listWeek: { buttonText: 'List Week' },
            listMonth: { buttonText: 'List Month' },
            listYear: { buttonText: 'List Year' },
        },
        displayEventTime: false, 
        eventClick: function(arg) {
            // opens events in a popup window
            window.open(arg.event.url, 'google-calendar-event', 'width=700,height=600');

            arg.jsEvent.preventDefault() // don't navigate in main tab
        },
        loading: function(bool) {
            // document.getElementById('loading').style.display = bool ? 'block' : 'none';
        }

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