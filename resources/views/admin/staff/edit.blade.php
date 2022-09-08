@extends('layouts.admin')
@section('content')
<script src="{{asset('admin/assets/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('admin/assets/plugins/colorpicker/bootstrap-colorpicker.css')}}"> 
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
                                                <h5><?php echo $heading;?> <?php echo (!empty($user['id']))?'Edit':"Add";?></h5>
                                            </div>
                                            <div class="card-body">                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php //dd($product);?>
                                                        <form name="user_frm" id="user_frm" method="post" action="{{route('admin_staff_edit')}}" enctype="multipart/form-data">
                                                            @csrf                                                            
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control required" placeholder="Enter Name" name="name" value="<?php echo (!empty($user['name']))?$user['name']:"";?>"/>
                                                            </div>                                                            
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" class="form-control required" placeholder="Enter Email" name="email" value="<?php echo (!empty($user['email']))?$user['email']:"";?>"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <div class="input-group">
                                                                    <?php 
                                                                        $status_type=["0"=>"Inactive","1"=>"Active"];
                                                                        if(!empty($status_type)){
                                                                            foreach ($status_type as $key => $value) {
                                                                    ?>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="status_type_{{$key}}" name="status" class="custom-control-input required" value="{{$key}}" <?php echo (isset($user['status']) && $user['status']==$key)?"checked='checked'":"";?>>
                                                                        <label class="custom-control-label" for="status_type_{{$key}}">{{$value}}</label>
                                                                    </div>
                                                                    <?php  } }?>                                                                
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Assign Color</label>
                                                                <div class="input-group" >
                                                                    <input type="text" id="assigned_color" class="form-control required" placeholder="Assign Color" name="assigned_color" value="<?php echo (!empty($user['assigned_color']))?$user['assigned_color']:"#00FF00";?>" readonly/>
                                                                </div>                                                           
                                                            </div>                                                           
                                                            <?php if(!empty($user['id'])){?>
                                                                <input type="hidden" name="id" value="<?php echo (!empty($user['id']))?$user['id']:"";?>">
                                                            <?php }else{?>
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="password" class="form-control required" placeholder="Enter Password" name="password" value="<?php echo (!empty($user['password']))?$user['password']:"";?>"/>
                                                                </div>
                                                            <?php }?>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
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
<script>
    $(document).ready(function(){
        $(function() {
            $("#assigned_color").colorpicker({ format: "hex" });
            $('#assigned_color').on('colorpickerChange', function(event) {
                $('#assigned_color').css('background-color', event.color.toString());
            });
            $('#assigned_color').on('colorpickerCreate', function(event) {
                $('#assigned_color').css('background-color', $(this).val());
            });
        });
        form_validation("#user_frm");
    });
</script>
@endsection