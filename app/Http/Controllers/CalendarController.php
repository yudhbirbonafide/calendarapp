<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    
    public function calender_setup(){
        return view('admin.calendar.index');
    }
}
