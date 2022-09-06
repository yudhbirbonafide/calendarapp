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
                                                        <?php //dd($product);?>
                                                        <form name="brand_frm" id="brand_frm" method="post" action="{{route('admin_products_edit')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Image</label>
                                                                <?php 
                                                                    $required='required';
                                                                    if(!empty($product['image'])){$required=''; }
                                                                ?>
                                                                <input type="file" class="form-control {{$required}}" placeholder="Enter Name" name="image" value=""/>
                                                                <?php if(!empty($product['image'])){?>
                                                                    <img src="{{asset($product['image'])}}" width="50" height="50" style="margin: 10px; border-radius: 10px;">
                                                                    <input type="hidden" name="old_image" value="{{$product['image']}}">
                                                                <?php }?>
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <input type="text" class="form-control required" placeholder="Enter Name" name="product_desc" value="<?php echo (!empty($product['product_desc']))?$product['product_desc']:"";?>"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>caliber</label>
                                                                <select name="caliber" class="form-control">
                                                                    <option value="">Please select a caliber</option>
                                                                    <?php if(!$calibers->isEmpty()){
                                                                        foreach($calibers as $val){    
                                                                    ?>
                                                                    <option value="{{$val['id']}}" <?php echo (!empty($product['caliber']) && $product['caliber']==$val['id']) ? "selected=selected":"";?>>{{$val['value']}}</option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Bullet Type</label>
                                                                <select name="bullet_type" class="form-control">
                                                                    <option value="">Please select a Bullet Type</option>
                                                                    <?php if(!$bullet_type->isEmpty()){
                                                                        foreach($bullet_type as $val){    
                                                                    ?>
                                                                    <option value="{{$val['id']}}" <?php echo (!empty($product['bullet_type']) && $product['bullet_type']==$val['id']) ? "selected=selected":"";?>>{{$val['value']}}</option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Bullet Weight</label>
                                                                <select name="bullet_weight" class="form-control">
                                                                    <option value="">Please select a Bullet Weight</option>
                                                                    <?php if(!$bullet_weight->isEmpty()){
                                                                        foreach($bullet_weight as $val){    
                                                                    ?>
                                                                    <option value="{{$val['id']}}" <?php echo (!empty($product['bullet_weight']) && $product['bullet_weight']==$val['id']) ? "selected=selected":"";?>>{{$val['value']}}</option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Casing</label>
                                                                <select name="casing" class="form-control ">
                                                                    <option value="">Please select a Casing</option>
                                                                    <?php if(!$casing->isEmpty()){
                                                                        foreach($casing as $val){    
                                                                    ?>
                                                                    <option value="{{$val['id']}}" <?php echo (!empty($product['casing']) && $product['casing']==$val['id']) ? "selected=selected":"";?>>{{$val['value']}}</option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Rounds</label>
                                                                <select name="rounds" class="form-control ">
                                                                    <option value="">Please select a Rounds</option>
                                                                    <?php if(!$rounds->isEmpty()){
                                                                        foreach($rounds as $val){    
                                                                    ?>
                                                                    <option value="{{$val['id']}}" <?php echo (!empty($product['rounds']) && $product['rounds']==$val['id']) ? "selected=selected":"";?>>{{$val['value']}}</option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Category</label>
                                                                <select name="category" class="form-control ">
                                                                    <option value="">Please select a Category</option>
                                                                    <?php if(!$sub_category->isEmpty()){
                                                                        foreach($sub_category as $val){    
                                                                    ?>
                                                                    <option value="{{$val['id']}}" <?php echo (!empty($product['category']) && $product['category']==$val['id']) ? "selected=selected":"";?>>{{$val['name']}}</option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Brands</label>
                                                                <select name="brands" class="form-control">
                                                                <option value="">Please select a Brand</option>
                                                                    <?php if(!$brands->isEmpty()){
                                                                        foreach($brands as $val){    
                                                                    ?>
                                                                    <option value="{{$val['id']}}" <?php echo (!empty($product['brands']) && $product['brands']==$val['id']) ? "selected=selected":"";?>>{{$val['value']}}</option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Retailers</label>
                                                                <select name="retailer" class="form-control">
                                                                    <option value="">Please select a Retailers</option>
                                                                    <?php if(!$retailer->isEmpty()){
                                                                        foreach($retailer as $val){    
                                                                    ?>
                                                                    <option value="{{$val['id']}}" <?php echo (!empty($product['retailer']) && $product['retailer']==$val['id']) ? "selected=selected":"";?>>{{$val['value']}}</option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Manufacturer</label>
                                                                <select name="manufacturer" class="form-control">
                                                                    <option value="">Please select a Manufacturer</option>
                                                                    <?php if(!$manufacturer->isEmpty()){
                                                                        foreach($manufacturer as $val){    
                                                                    ?>
                                                                    <option value="{{$val['id']}}" <?php echo (!empty($product['manufacturer']) && $product['manufacturer']==$val['id']) ? "selected=selected":"";?>>{{$val['value']}}</option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Price</label>
                                                                <input type="text" class="form-control required" placeholder="Enter Price" name="price" value="<?php echo (!empty($product['price']))?$product['price']:"";?>"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>CPR</label>
                                                                <input type="text" class="form-control required" placeholder="Enter Price" name="cpr" value="<?php echo (!empty($product['cpr']))?$product['cpr']:"";?>"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Retailer Product Url</label>
                                                                <textarea class="form-control" placeholder="Retailer Product Url" name="retailer_prod_url" ><?php echo (!empty($product['retailer_prod_url']))?$product['retailer_prod_url']:"";?></textarea>
                                                            </div>
                                                            <?php if(!empty($product['id'])){?>
                                                                <input type="hidden" name="id" value="<?php echo (!empty($product['id']))?$product['id']:"";?>">
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