@extends('layouts.app')

@section('content')
<script src="{{asset('calendar/main.js')}}"></script>
<link rel="stylesheet" href="{{asset('calendar/main.css')}}">
<script src="{{asset('admin/assets/js/noty.js')}}"></script>
<link rel="stylesheet" href="{{asset('admin/assets/css/noty.css')}}">
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
    var restricted_dated=[];
    <?php if(!empty($restricted_dated)){
        foreach ($restricted_dated as $key => $value) {            
        ?>
            restricted_dated.push('{{$value}}');
    <?php }} ?>
    var calendar;
    var events=<?php echo $levents;?>;
    events=JSON.parse(JSON.stringify(events));    
    // restricted_dated=JSON.parse(JSON.stringify(restricted_dated));
    // console.log(restricted_dated);
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
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
            // hiddenDays: [ 1, 3, 5 ] ,
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
                var template = '<tr><th class="o-box-name">Event Title</td><td>'+arg.event.title+'</td>';
                template += '<tr><th class="o-box-name">Event Start Date</td><td>'+arg.event.start+'</td>';
                template += '<tr><th class="o-box-name">Event End Date</td><td>'+arg.event.end+'</td>';
                template += '<tr><th class="o-box-name">Event Status</td><td>'+arg.event.extendedProps.status+'</td>';
            },
            loading: function(bool) {
                // document.getElementById('loading').style.display = bool ? 'block' : 'none';
            },
            select: function(arg) {
                let start=moment(arg.start).format('YYYY/MM/DD hh:mm');
                let end=moment(arg.end).format('YYYY/MM/DD hh:mm');
                $("#from_date").val(start);
                $("#to_date").val(end);
                $("#leave_popup").modal('show');
            },
            eventMouseEnter: function(mouseEnterInfo) {
                // console.log(mouseEnterInfo.el);
                $(mouseEnterInfo.el).attr({"data-toggle":"tooltip",title:mouseEnterInfo.event.extendedProps.status}).addClass('createdDiv');
            },
            eventMouseLeave: function(mouseEnterInfo) {
                $(mouseEnterInfo.el).removeClass('createdDiv').removeAttr('data-toggle','title');
            },            
            selectAllow: function (arg) {
                let current_date=moment(arg.start).format('YYYY-MM-DD');               
                if(restricted_dated.includes(current_date)){
                    // console.log("hello");
                    return false;
                }else{
                    return true;
                }
            },
            dayCellDidMount:function(arg){
                let current_date=moment(arg.date).format('YYYY-MM-DD');                
                if(restricted_dated.includes(current_date)){
                    $(arg.el).css("background-color","#cccccc");                    
                }
            },
            events: events

        });

        calendar.render();
    });

    function submit_form(){
       var data=$('#leave_frm').serialize();
       $.ajax({
            url:"{{route('save_event')}}",
            method:"POST", 
            data:data+'&_token={{ csrf_token() }}',
            success:function(response) {
                if(response.success){
                    $("#liveToast").removeClass('hide').addClass('show');
                    $('#leave_frm')[0].reset();
                    $("#leave_popup").modal('hide').data( 'bs.modal', null );
                    new Noty({ type: 'success', layout: 'topRight', text: 'Record has been updated successfully',timeout:3000 }).show();
                    calendar.addEvent({title: $("#event_title").val(), start: $("#from_date").val(), end: $("#to_date").val(),  allDay: true });
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
        $('body').tooltip({  selector: '.createdDiv'});
        $('#from_date').datetimepicker({format: 'YYYY-MM-DD hh:mm'});
        $('#to_date').datetimepicker({format: 'YYYY-MM-DD hh:mm'});
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="liveToast" class="toast align-items-center text-white bg-success border-0 hide" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Your request has been sent.
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                <form name="leave_frm" id="leave_frm">
                    <div class="mb-3">
                        <label for="event_title" class="col-form-label">Title</label>                
                        <input type="text" name="event_title" class="form-control required" id="event_title" value="">
                    </div>
                    <div class="mb-3 row">
                        <label for="from_date" class="col-sm-2 col-form-label">From</label>
                        <div class="col-sm-10">
                            <input type="text" name="from_date" class="form-control required" id="from_date" value="" >
                        </div>                
                    </div>
                    <div class="mb-3 row">
                        <label for="to_date" class="col-sm-2 col-form-label">To</label>
                        <div class="col-sm-10" id="datetimepicker2">
                            <input type="text" name="to_date" class="form-control required" id="to_date" value="" >
                        </div>                
                    </div>
                    <div class="mb-3">
                        <?php 
                            $leave_type=["1"=>"Sick Leave","2"=>"Work Leave","3"=>"Maternal Leave","4"=>"Marriage Leave","5"=>"Anniversary Leave"];
                        ?>
                        <label for="leave_type" class="col-form-label">Selection Type</label>                
                        <select name="leave_type" class="form-control required">
                            <option value="">Please select atleast one value</option>
                            <?php if(!empty($leave_type)){
                                foreach ($leave_type as $key => $value) {?>
                                <option value="{{$key}}">{{$value}}</option>             
                            <?php  } }?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="to_date" class="col-sm-2 col-form-label">Description</label>                
                        <textarea name="description" class="form-control required" id="description"></textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
