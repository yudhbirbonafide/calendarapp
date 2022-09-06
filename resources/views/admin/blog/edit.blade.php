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
                                                        <form name="brand_frm" id="brand_frm" method="post" action="{{route('admin_blogs_edit')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Image</label>
                                                                <?php 
                                                                    $required='required';
                                                                    if(!empty($blog['image'])){$required=''; }
                                                                ?>
                                                                <input type="file" class="form-control {{$required}}" placeholder="Enter Name" name="image" value=""/>
                                                                <?php if(!empty($blog['image'])){?>
                                                                    <img src="{{asset($blog['image'])}}" width="50" height="50" style="margin: 10px; border-radius: 10px;">
                                                                    <input type="hidden" name="old_image" value="{{$blog['image']}}">
                                                                <?php }?>
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" class="form-control required" placeholder="Enter Price" name="title" value="<?php echo (!empty($blog['title']))?$blog['title']:"";?>"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea class="form-control required blog_editor" placeholder="Enter Description" name="blog_desc"><?php echo (!empty($blog['blog_desc']))?$blog['blog_desc']:"";?></textarea>
                                                            </div>
                                                            <?php if(!empty($blog['id'])){?>
                                                                <input type="hidden" name="id" value="<?php echo (!empty($blog['id']))?$blog['id']:"";?>">
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
    ClassicEditor
    .create(document.querySelector( '.blog_editor' ), {               
        licenseKey: '',
        removePlugins: ['Title'],
        placeholder: '',

    }).then( editor => {
        window.editor = editor; 
    }).catch( error => {
        console.error( 'Oops, something went wrong!' );
        console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
        console.warn( 'Build id: gcpkbjs6hwf4-uj82r3n1zsgc' );
        console.error( error );
    });
</script>
@endsection