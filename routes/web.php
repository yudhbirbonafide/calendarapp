<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AmmunitionController;
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
        Route::get('/ammunition/brands', [AmmunitionController::class, 'brands'])->name('admin_ammunition_brands');
        Route::match(['get', 'post'],'/ammunition/brands/edit/{id?}', [AmmunitionController::class, 'brand_edit'])->name('admin_ammunition_brand_edit');
        Route::get('/ammunition/brands/delete/{id}', [AmmunitionController::class, 'brand_delete'])->name('admin_ammunition_brand_delete');

        Route::get('/ammunition/bullettype', [AmmunitionController::class, 'bullettype'])->name('admin_ammunition_bullettype');
        Route::match(['get', 'post'],'/ammunition/bullettype/edit/{id?}', [AmmunitionController::class, 'bullettype_edit'])->name('admin_ammunition_bullettype_edit');
        Route::get('/ammunition/bullettype/delete/{id}', [AmmunitionController::class, 'bullettype_delete'])->name('admin_ammunition_bullettype_delete');

        Route::get('/ammunition/caliber', [AmmunitionController::class, 'caliber'])->name('admin_ammunition_caliber');
        Route::match(['get', 'post'],'/ammunition/caliber/edit/{id?}', [AmmunitionController::class, 'caliber_edit'])->name('admin_ammunition_caliber_edit');
        Route::get('/ammunition/caliber/delete/{id}', [AmmunitionController::class, 'caliber_delete'])->name('admin_ammunition_caliber_delete');

        Route::get('/ammunition/casing', [AmmunitionController::class, 'casing'])->name('admin_ammunition_casing');
        Route::match(['get', 'post'],'/ammunition/casing/edit/{id?}', [AmmunitionController::class, 'casing_edit'])->name('admin_ammunition_casing_edit');
        Route::get('/ammunition/casing/delete/{id}', [AmmunitionController::class, 'casing_delete'])->name('admin_ammunition_casing_delete');

        Route::get('/ammunition/retailer', [AmmunitionController::class, 'retailer'])->name('admin_ammunition_retailer');
        Route::match(['get', 'post'],'/ammunition/retailer/edit/{id?}', [AmmunitionController::class, 'retailer_edit'])->name('admin_ammunition_retailer_edit');
        Route::get('/ammunition/retailer/delete/{id}', [AmmunitionController::class, 'retailer_delete'])->name('admin_ammunition_retailer_delete');

        Route::get('/ammunition/rounds', [AmmunitionController::class, 'rounds'])->name('admin_ammunition_rounds');
        Route::match(['get', 'post'],'/ammunition/rounds/edit/{id?}', [AmmunitionController::class, 'rounds_edit'])->name('admin_ammunition_rounds_edit');
        Route::get('/ammunition/rounds/delete/{id}', [AmmunitionController::class, 'rounds_delete'])->name('admin_ammunition_rounds_delete');

        Route::get('/ammunition/bulletweight', [AmmunitionController::class, 'bulletweight'])->name('admin_ammunition_bulletweight');
        Route::match(['get', 'post'],'/ammunition/bulletweight/edit/{id?}', [AmmunitionController::class, 'bulletweight_edit'])->name('admin_ammunition_bulletweight_edit');
        Route::get('/ammunition/bulletweight/delete/{id}', [AmmunitionController::class, 'bulletweight_delete'])->name('admin_ammunition_bulletweight_delete');

        Route::get('/ammunition/category', [AmmunitionController::class, 'category'])->name('admin_ammunition_category');
        Route::match(['get', 'post'],'/ammunition/category/edit/{id?}', [AmmunitionController::class, 'category_edit'])->name('admin_ammunition_category_edit');
        Route::get('/ammunition/category/delete/{id}', [AmmunitionController::class, 'category_delete'])->name('admin_ammunition_category_delete');


        Route::get('/ammunition/subcategory', [AmmunitionController::class, 'subcategory'])->name('admin_ammunition_subcategory');
        Route::match(['get', 'post'],'/ammunition/subcategory/edit/{id?}', [AmmunitionController::class, 'subcategory_edit'])->name('admin_ammunition_subcategory_edit');
        Route::get('/ammunition/subcategory/delete/{id}', [AmmunitionController::class, 'subcategory_delete'])->name('admin_ammunition_subcategory_delete');


        Route::get('/ammunition/manufacturer', [AmmunitionController::class, 'manufacturer'])->name('admin_ammunition_manufacturer');
        Route::match(['get', 'post'],'/ammunition/manufacturer/edit/{id?}', [AmmunitionController::class, 'manufacturer_edit'])->name('admin_ammunition_manufacturer_edit');
        Route::get('/ammunition/manufacturer/delete/{id}', [AmmunitionController::class, 'manufacturer_delete'])->name('admin_ammunition_manufacturer_delete');  
        
        /** Calender Setup  */
        Route::get('/calender/setup', [CalendarController::class, 'calender_setup'])->name('admin_calender_setup');
        
    });
});
