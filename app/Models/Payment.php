<?php

namespace App\Models;

use App\Filters\Contracts\Filterable;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\Payment\PaymentPresenter;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use Filterable,Presentable;
    protected $guarded = ['id'];
    protected $webPresenter = PaymentPresenter::class;
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
