<?php

namespace App\Presenters\Web\Order;

use App\Constants\Constant;
use App\Helpers\Format\Date;
use App\Presenters\Contracts\Presenter;

class OrderPresenter extends Presenter
{



    public function orderDate()
    {
        return Date::toJalaliFormat($this->entity->updated_at);

    }

    public function status()
    {
        if ($this->entity->status == Constant::PENDING) {
            return " <div class='badge badge-light-warning'>در انتظار</div>";
        } elseif ($this->entity->status == Constant::PURCHASED) {
            return "  <div class='badge badge-light-success'>پرداخت شده</div>";
        }elseif ($this->entity->status == Constant::REJECTED) {
            return "  <div class='badge badge-light-danger'>لغو شده</div>";
        }elseif ($this->entity->status == Constant::SHIPPING) {
            return "  <div class='badge badge-light-warning'>در حال ارسال</div>";
        }elseif ($this->entity->status == Constant::DELIVERED) {
            return "  <div class='badge badge-light-success'>رسیده</div>";
        }
        return null;
    }

}
