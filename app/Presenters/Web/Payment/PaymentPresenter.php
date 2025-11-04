<?php

namespace App\Presenters\Web\Payment;

use App\Constants\Constant;
use App\Helpers\Format\Date;
use App\Presenters\Contracts\Presenter;

class PaymentPresenter extends Presenter
{
    public function payDate()
    {
        return Date::toJalaliFormat($this->entity->updated_at);

    }


    public function status()
    {
        if ($this->entity->status == Constant::PENDING) {
            return " <div class='badge badge-light-warning'>در انتظار</div>";
        } elseif ($this->entity->status == Constant::CONFIRMED) {
            return "  <div class='badge badge-light-success'>قبول شده</div>";
        }elseif ($this->entity->status == Constant::REJECTED) {
            return "  <div class='badge badge-light-danger'>رد شده</div>";
        }
        return null;
    }

    public function gatewayName()
    {
        if (!is_null($this->entity->gateway_name)){
            if ($this->entity->gateway_name == Constant::BAZAAR) {
                return "کافه بازار";
            } elseif ($this->entity->gateway_name == Constant::ZARINPAL) {
                return "زرین پال";
            }elseif ($this->entity->gateway_name == Constant::MYKET) {
                return "مایکت";
            }else{
                return "نامشخص";
            }
        }
    }

    public function discountCodeAmount()
    {


        if (!is_null($this->entity->discount_code_id)){
            return "<a title=".$this->entity->discountCode->title." href=".
                route('admin.discount_codes.edit',$this->entity->discount_code_id)." >"
                .number_format($this->entity->discountCode->discount_price).
                "</a>";
        }
        return 0;

    }
}
