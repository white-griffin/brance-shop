<?php

namespace App\Presenters\Api\Product;

use App\Constants\Constant;
use App\Presenters\Contracts\Presenter;

class ProductPresenter extends Presenter
{
    public function image()
    {

        if (is_null($this->entity->image) || $this->entity->image == "") {
            return asset('admin-assets/media/avatars/blank.png');
        }
        return str_replace('\\', '/', asset(Constant::PRODUCT_IMAGE_PATH . DIRECTORY_SEPARATOR . $this->entity->image));
    }

    public function status()
    {
        if (!is_null($this->entity->status) && $this->entity->status == Constant::ACTIVE) {
            return "<span class='badge badge-light-success'>" . Constant::getStatuses($this->entity->status) . "</span>";
        } elseif ($this->entity->status == "in-active") {
            return "<span class='badge badge-light-danger'>" . Constant::getStatuses($this->entity->status) . "</span > ";
        }
        return null;
    }

    public function discountStatus()
    {
        if (!is_null($this->entity->discount_status) && $this->entity->discount_status == Constant::ACTIVE) {
            return "<span class='badge badge-light-success'>" . Constant::getStatuses($this->entity->discount_status) . "</span>";
        } elseif ($this->entity->discount_status == "in-active") {
            return "<span class='badge badge-light-danger'>" . Constant::getStatuses($this->entity->discount_status) . "</span > ";
        }
        return null;
    }

    public function specialStatus()
    {
        if (!is_null($this->entity->special_status) && $this->entity->special_status == Constant::ACTIVE) {
            return "<span class='badge badge-light-success'>" . Constant::getStatuses($this->entity->special_status) . "</span>";
        } elseif ($this->entity->special_status == "in-active") {
            return "<span class='badge badge-light-danger'>" . Constant::getStatuses($this->entity->special_status) . "</span > ";
        }
        return null;
    }
}
