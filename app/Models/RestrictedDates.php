<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RestrictedDates extends Model{
    protected $table = 'tbl_restricted_dates';
    protected $guarded = [];
    public $timestamps = false;
}
