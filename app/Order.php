<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id', 'status'];
    
    public function getCreatedAtAttribute($value)
    {
        $datetime = Carbon::createFromDate($value);
        return $datetime->diffForHumans();
    }
}
