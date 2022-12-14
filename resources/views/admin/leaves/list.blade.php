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
                                            <h5 class="m-b-10"><?php echo $heading;?></h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:"><?php echo $heading;?> List</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Page-header End -->

                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="card Recent-Users">
                                            <div class="card-header">
                                                <h5><?php echo $heading;?> List</h5>
                                                <a href="{{route('admin_staff_edit')}}" class="label theme-bg text-white f-12" style="float:right;">Add <?php echo $heading;?></a>
                                            </div>
                                            <div class="card-block px-0 py-3">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th width="10%">Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(!empty($result)){
                                                                foreach($result as $val){    
                                                            ?>
                                                            <tr class="unread">
                                                                <td>{{$val['id']}}</td>                                                                
                                                                <td><?php echo (!empty($val['restricted_dated']))?$val['restricted_dated']:"";?></td>                                                                
                                                                <td>
                                                                    <a href="{{route('admin_leaves_edit',['id'=>$val['id']])}}" class="label theme-bg2 text-white f-12">Edit</a>
                                                                    <a href="{{route('admin_leaves_delete',['id'=>$val['id']])}}" class="label theme-bg text-white f-12" onclick="return delete_confirmation();">Delete</a>
                                                                </td>
                                                            </tr>
                                                            <?php }}else{?>
                                                                <tr class="unread">  
                                                                    <td colspan="4">No Record Found.</td>
                                                                </tr> 
                                                            <?php }?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            {{ $result->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
<!-- [ Main Content ] end -->
@endsection