<?php

namespace App\Presenters\Web\DiscountCode;

use App\Constants\Constant;
use App\Helpers\Format\Date;
use App\Presenters\Contracts\Presenter;

class DiscountCodePresenter extends Presenter
{

    public function discountType()
    {
        $type = "";
        if (!is_null($this->entity->discount_type)) {

            if ($this->entity->discount_type == Constant::PERCENT) {
                return " <div class='badge badge-light-success'>درصدی</div>";
            } elseif ($this->entity->discount_type == Constant::AMOUNT) {
                return "  <div class='badge badge-light-info'>مقدار</div>";
            }

        }
        return $type;
    }

    public function expireDate()
    {

        return Date::toJalaliFormat($this->entity->expire_date);

    }

    public function status()
    {
        $status = "";
        if (!is_null($this->entity->status)) {

            if ($this->entity->status == Constant::ACTIVE) {
                return " <div class='badge badge-light-success'>فعال</div>";
            } elseif ($this->entity->status == Constant::IN_ACTIVE) {
                return "  <div class='badge badge-light-danger'>غیر فعال</div>";
            }

        }
        return $status;
    }

    public function discountPercent()
    {
        if (is_null($this->entity->discount_percent)) {

            return "  <div class='badge badge-light-danger'>تخفیف با مبلغ</div>";

        }else{
            return $this->entity->discount_percent."%";
        }
    }
}
