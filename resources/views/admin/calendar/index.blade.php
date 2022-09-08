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
                    <!-- <div id='loading'>loading...</div> -->
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
    var calendar;
    var events=<?php echo $levents;?>;
    // console.log(JSON.parse(JSON.stringify(events)));
    events=JSON.parse(JSON.stringify(events));
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
            eventClick: async function(arg) {
                let event_id=arg.event.extendedProps.event_id;
                // console.log(event_id);
                await fetch_event(event_id);                
            },
            loading: function(bool) {
                // document.getElementById('loading').style.display = bool ? 'block' : 'none';
            },
            select: function(arg) {

            },
            events: events

        });

        calendar.render();
    });   
    function submit_form(){
       var data=$('#leave_frm').serialize();
       $.ajax({
            url:"{{route('admin_save_event_info')}}",
            method:"POST", 
            data:data+'&_token={{ csrf_token() }}',
            success:function(response) {
                if(response.success){
                    // $("#liveToast").removeClass('hide').addClass('show');
                    $("#leave_popup").modal('hide').data( 'bs.modal', null );
                    new Noty({ type: 'success', layout: 'topRight', text: 'Record has been updated successfully',timeout:3000 }).show(); 
                }else{
                    alert('Your Request is not sent. Please check you input data');
                }
            },
            error:function(){
                
            }
        });
    }
    function fetch_event(event_id){
        $.ajax({
            url:"{{route('admin_calender_fetch_event_info')}}",
            method:"POST", 
            data:{event_id:event_id,'_token':'{{ csrf_token() }}'},
            success:function(response) {
                if(response.success){                    
                    $('#processed_event').html(response.html);  
                    $("#leave_popup").modal('show');                 
                }else{
                    alert('unable to fetch the event.');
                }
            },
            error:function(){
                alert('Error: unable to fetch the event.');
            }
        });
    }
    $(document).ready(function(){        
        $("#leave_frm").validate({
            submitHandler: function (form) {
                submit_form();
                return false;
            }
        });        
    });
    </script>
     <style>
        .fc .fc-button-group > .fc-button {
            position: relative;
            flex: 1 1 auto;
            margin-right: 2px;
        }
    </style>
    <div class="modal" tabindex="-1" id="leave_popup">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                                   
                <form name="leave_frm" id="leave_frm">
                    <div id="processed_event">

                    </div>
                    
                </div> <!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    @endsection