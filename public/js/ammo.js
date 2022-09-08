function form_validation(form_name){
    $(form_name).validate();
}
function delete_confirmation(){
    return confirm( 'Are you sure you wish to delete this record?' );
}