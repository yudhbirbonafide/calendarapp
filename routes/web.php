<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CalendarController;
use App\Models\LeaveEvent;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // echo "Hello world";
    $levents=LeaveEvent::join('users', 'tbl_leave_events.user_id', '=', 'users.id')->select('tbl_leave_events.*','users.assigned_color') ->get()->toArray();
    $final_array=[];
    if(!empty($levents)){
        foreach ($levents as $key => $value) {
            $data=[
                "title"     => (!empty($value['event_title']))?$value['event_title']:"",
                "start"     => (!empty($value['start_date']))?date('Y-m-d H:i:s',strtotime($value['start_date'])):"",
                "end"       => (!empty($value['end_date']))?date('Y-m-d H:i:s',strtotime($value['end_date'])):"",
                "color"     => (!empty($value['assigned_color']))?$value['assigned_color']:"#0d6efd",
                "status"    =>  (!empty($value['status']))?'Approved':"Pending",
                "event_id"    =>  (!empty($value['id']))?$value['id']:"0",
            ];
            $final_array[]=$data;
        }
    }
    return view('welcome',['levents'=>json_encode($final_array)]);
});
Route::post('/fetch/home/event', function (Request $request) {
    if(!empty($request->event_id)){
        $single_events=LeaveEvent::where(['id'=>$request->event_id])->first()->toArray();
        $evnt_dta= view('admin.calendar.fetch_event_info',['single_events'=>$single_events])->render();
        $m_final_data=['success'=>true,"html"=>$evnt_dta];
        return response()->json($m_final_data);
    }else{
        $m_final_data=['success'=>false,"html"=>""];
        return response()->json($m_final_data);
    }
})->name('fetch_home_event');;

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/staff/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('staff_dashboard');
    Route::post('/staff/event', [App\Http\Controllers\HomeController::class, 'save_event'])->name('save_event');
});

Route::prefix('admin')->group(function () {

    Route::match(['get', 'post'],'/login', [AdminController::class, 'index'])->name('admin_login');

    Route::middleware(['adminAuth'])->group(function () {
        Route::get('/dashboard', [CalendarController::class, 'calender_setup'])->name('admin_dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
        
        /* Ammunation Components Routes*/       
        Route::get('/users/staff', [StaffController::class, 'staff'])->name('admin_staffs');
        Route::match(['get', 'post'],'/users/staff/edit/{id?}', [StaffController::class, 'staff_edit'])->name('admin_staff_edit');
        Route::get('/users/staff/delete/{id}', [StaffController::class, 'staff_delete'])->name('admin_staff_delete');  
        
        /** Calender Setup  */
        Route::get('/calender/setup', [CalendarController::class, 'calender_setup'])->name('admin_calender_setup');
        Route::post('/calender/event/fetch', [CalendarController::class, 'fetch_event_info'])->name('admin_calender_fetch_event_info');
        Route::post('/calender/event/save', [CalendarController::class, 'save_event_info'])->name('admin_save_event_info');
        Route::post('/calender/event/restricted', [CalendarController::class, 'save_restricted_dated_info'])->name('admin_restricted_dated_info');

        Route::get('/calender/restricted/leaves', [CalendarController::class, 'leaves'])->name('admin_leaves');
        Route::match(['get', 'post'],'/calender/restricted/leaves/edit/{id?}', [CalendarController::class, 'leaves_edit'])->name('admin_leaves_edit');
        Route::get('calender/restricted/leaves/delete/{id}', [CalendarController::class, 'leaves_delete'])->name('admin_leaves_delete');
        
    });
});
