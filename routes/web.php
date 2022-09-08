<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CalendarController;

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
    echo "Hello world";
    //return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/staff/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('staff_dashboard');
    Route::post('/staff/event', [App\Http\Controllers\HomeController::class, 'save_event'])->name('save_event');
});

Route::prefix('admin')->group(function () {

    Route::match(['get', 'post'],'/login', [AdminController::class, 'index'])->name('admin_login');

    Route::middleware(['adminAuth'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
        
        /* Ammunation Components Routes*/       
        Route::get('/users/staff', [StaffController::class, 'staff'])->name('admin_staffs');
        Route::match(['get', 'post'],'/users/staff/edit/{id?}', [StaffController::class, 'staff_edit'])->name('admin_staff_edit');
        Route::get('/users/staff/delete/{id}', [StaffController::class, 'staff_delete'])->name('admin_staff_delete');  
        
        /** Calender Setup  */
        Route::get('/calender/setup', [CalendarController::class, 'calender_setup'])->name('admin_calender_setup');
        Route::post('/calender/event/fetch', [CalendarController::class, 'fetch_event_info'])->name('admin_calender_fetch_event_info');
        Route::post('/calender/event/save', [CalendarController::class, 'save_event_info'])->name('admin_save_event_info');
        
    });
});
