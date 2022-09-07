<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LeaveEvent extends Model{
    protected $table = 'tbl_leave_events';
    protected $guarded = [];
    public $timestamps = false;
}
