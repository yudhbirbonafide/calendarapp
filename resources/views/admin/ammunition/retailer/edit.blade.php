@extends('layouts.admin')
@section('content')
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
                                            <li class="breadcrumb-item"><a href="javascript:"><?php echo $heading;?> <?php echo (!empty($result['id']))?'Edit':"Add";?></a></li>
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
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form name="brand_frm" id="brand_frm" method="post" action="{{route('admin_ammunition_retailer_edit')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control required" placeholder="Enter Name" name="value" value="<?php echo (!empty($result['value']))?$result['value']:"";?>"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Image</label>
                                                                <?php 
                                                                    $required='required';
                                                                    if(!empty($result['retailer_img'])){$required=''; }
                                                                ?>
                                                                <input type="file" class="form-control {{$required}}" placeholder="Select Retailer Image" name="cat_img" value=""/>
                                                                <?php if(!empty($result['retailer_img'])){?>
                                                                    <img src="{{asset($result['retailer_img'])}}" width="50" height="50" style="margin: 10px; border-radius: 10px;">
                                                                    <input type="hidden" name="old_retailer_img" value="{{$result['retailer_img']}}">
                                                                <?php }?>
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Website Url</label>
                                                                <input type="text" class="form-control required" placeholder="Enter Name" name="website_url" value="<?php echo (!empty($result['website_url']))?$result['website_url']:"";?>"/>
                                                            </div>
                                                            <?php if(!empty($result['id'])){?>
                                                                <input type="hidden" name="id" value="<?php echo (!empty($result['id']))?$result['id']:"";?>">
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
        form_validation("#brand_frm");
    });
</script>
@endsection