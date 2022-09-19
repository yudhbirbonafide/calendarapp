@extends('layouts.app')

@section('content')
<script src="{{asset('calendar/main.js')}}"></script>
<link rel="stylesheet" href="{{asset('calendar/main.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/plugins/jquery-ui/jquery-ui.min.css')}}"> 
<script src="{{asset('admin/assets/plugins/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('admin/assets/plugins/jquery-ui/jquery-ui.multidatespicker.js')}}"></script>
<link rel="stylesheet" href="{{asset('admin/assets/plugins/datetimepicker/bootstrap-datetimepicker.min.css')}}"> 
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="{{asset('admin/assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <?php //dump(json_encode($levents));die;?>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id='calendar'></div>
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
                    new Noty({ type: 'error', layout: 'topRight', text: 'Your Request is not sent. Please check you input data',timeout:3000 }).show();
                }
            },
            error:function(){
                new Noty({ type: 'error', layout: 'topRight', text: 'Your Request is not sent. Error occuring on processing request',timeout:3000 }).show(); 
            }
        });
    }
    function fetch_event(event_id){
        $.ajax({
            url:"{{route('fetch_home_event')}}",
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
    function exclude_dated_form(){
       var data=$('#restricted_dated_frm').serialize();
       $.ajax({
            url:"{{route('admin_restricted_dated_info')}}",
            method:"POST", 
            data:data+'&_token={{ csrf_token() }}',
            success:function(response) {
                if(response.success){;
                    $('#restricted_dated').val("");
                    new Noty({ type: 'success', layout: 'topRight', text: 'Record has been created successfully',timeout:3000 }).show(); 
                }else{
                    new Noty({ type: 'error', layout: 'topRight', text: 'Your Request is not sent. Please check you input data',timeout:3000 }).show();
                }
            },
            error:function(){
                new Noty({ type: 'error', layout: 'topRight', text: 'Your Request is not sent. Error occuring on processing request',timeout:3000 }).show(); 
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
        $("#restricted_dated_frm").validate({
            submitHandler: function (form) {
                exclude_dated_form();
                return false;
            }
        });
        $('#restricted_dated').multiDatesPicker({dateFormat: "yy-mm-dd"}); 
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
                    
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
