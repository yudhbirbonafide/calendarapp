@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="{{asset('admin/assets/plugins/jquery-ui/jquery-ui.min.css')}}"> 
<script src="{{asset('admin/assets/plugins/jquery-ui/jquery-ui.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
 <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="page-header"> <!-- Page-header Start -->
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10"><?php echo $heading;?>s</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:"><?php echo $heading;?> <?php echo (!empty($user['id']))?'Edit':"Add";?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Page-header End -->

                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><?php echo $heading;?> <?php echo (!empty($result['id']))?'Edit':"Add";?></h5>
                                            </div>
                                            <div class="card-body">                                                
                                                <div class="card-block">                                            
                                                    <form name="restricted_dated_frm" id="restricted_dated_frm" method="post" action="{{route('admin_leaves_edit')}}">
                                                        @csrf 
                                                        <div class="d-flex p-3 bg-secondary text-white">
                                                            <input type="text" class="form-control" id="restricted_dated" name="restricted_dated" placeholder="Select dates that you want to exculde from leave calendar"/>
                                                            <input type="hidden" name="id" value="<?php echo (!empty($result['id']))?$result['id']:"";?>">
                                                            <input type="submit" name="date_btn" class="btn btn-primary ml-4" value="submit">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- card End -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
<!-- [ Main Content ] end -->
<?php 
if(!empty($result['restricted_dated'])){
    $date_array=json_decode($result['restricted_dated'],1);
    $start_date=current($date_array);
    $end_date=end($date_array);
}
?>
<script>
    var start="<?php echo (!empty($start_date))?$start_date:date('Y-m-d');?>";
    var end="<?php echo (!empty($end_date))?$end_date:date('Y-m-d');?>";
    $(document).ready(function(){
        $('#restricted_dated').daterangepicker({
            locale: {format: "YYYY-MM-DD"},
            startDate: moment(start),
            endDate: moment(end),
    
        }); 
        $('#restricted_dated').on('show.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' ~ ' + picker.endDate.format('YYYY-MM-DD'));
        });
        $('#restricted_dated').on('showCalendar.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' ~ ' + picker.endDate.format('YYYY-MM-DD'));
        });
        $('#restricted_dated').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' ~ ' + picker.endDate.format('YYYY-MM-DD'));
        });
        $('#restricted_dated').val(start+'~'+end);
        $('#restricted_dated').on('focusout',function(){
            $('#restricted_dated').val(start+' ~ '+end);
        });
    });
</script>
@endsection