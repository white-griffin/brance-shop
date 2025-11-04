<?php

namespace App\Models;

use App\Filters\Contracts\Filterable;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\Order\OrderPresenter;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Presentable,Filterable;
    protected $guarded = ['id'];
    protected $webPresenter = OrderPresenter::class;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function receiver()
    {
        return $this->hasOne(OrderReceiver::class,'order_id');
    }
}
