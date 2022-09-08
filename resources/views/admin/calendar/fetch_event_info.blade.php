<div class="mb-3">
    <label for="event_title" class="col-form-label">Title</label>                
    <input type="text" name="event_title" class="form-control required" id="event_title" value="<?php echo (!empty($single_events['event_title']))?$single_events['event_title']:"";?>">
</div>
<div class="mb-3 row">
    <label for="from_date" class="col-sm-2 col-form-label">From</label>
    <div class="col-sm-10">
        <input type="text" name="from_date" class="form-control required" id="from_date" value="<?php echo (!empty($single_events['start_date']))?$single_events['start_date']:"";?>">
    </div>                
</div>
<div class="mb-3 row">
    <label for="to_date" class="col-sm-2 col-form-label">To</label>
    <div class="col-sm-10">
        <input type="text" name="to_date" class="form-control required" id="to_date" value="<?php echo (!empty($single_events['end_date']))?$single_events['end_date']:"";?>">
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
             <option value="{{$key}}" <?php echo (!empty($single_events['leave_type']) && $single_events['leave_type']==$key)?"selected='selected'":"";?>>{{$value}}</option>             
        <?php  } }?>
    </select>
</div>
<div class="mb-3">
    <label for="to_date" class="col-form-label">Description</label>                
    <textarea name="description" class="form-control required" id="description"><?php echo (!empty($single_events['description']))?$single_events['description']:"";?></textarea>
</div>
<?php 
    $status_type=["0"=>"Pending","1"=>"Approved","2"=>"Cancelled"];
    if(!empty($status_type)){
        foreach ($status_type as $key => $value) {
?>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="status_type_{{$key}}" name="status" class="custom-control-input" value="{{$key}}" <?php echo (isset($single_events['status']) && $single_events['status']==$key)?"checked='checked'":"";?>>
        <label class="custom-control-label" for="status_type_{{$key}}">{{$value}}</label>
    </div>
<?php  } }?>
<input type="hidden" name="event_id" value="<?php echo (!empty($single_events['id']))?$single_events['id']:"";?>">