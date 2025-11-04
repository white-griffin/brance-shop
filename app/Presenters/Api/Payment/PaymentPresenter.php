<?php

namespace App\Presenters\Api\Payment;

use App\Constants\Constant;
use App\Helpers\Format\Date;
use App\Presenters\Contracts\Presenter;

class PaymentPresenter extends Presenter
{
    public function orderableTitle()
    {
        return $this->entity->order->orderable->app_title;
    }

    public function status()
    {
        if ($this->entity->status == Constant::PENDING) {
            return 0;
        } elseif ($this->entity->status == Constant::CONFIRMED) {
            return 1;
        }elseif ($this->entity->status == Constant::REJECTED) {
            return 2;
        }
        return null;
    }

    public function deliveryStatus()
    {
        if ($this->entity->order->delivery_status == Constant::PENDING) {
            return 0;
        } elseif ($this->entity->order->delivery_status == Constant::SHIPPING) {
            return 1;
        }elseif ($this->entity->order->delivery_status == Constant::DELIVERED) {
            return 2;
        }elseif ($this->entity->order->delivery_status == Constant::REJECTED) {
            return 3;
        }
        return null;
    }

    public function payDate()
    {
        return Date::toJalaliFormat($this->entity->updated_at);
    }

}
