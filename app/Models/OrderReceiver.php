<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReceiver extends Model
{
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
