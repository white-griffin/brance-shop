<?php

namespace App\Presenters\Web\Slider;

use App\Constants\Constant;
use App\Presenters\Contracts\Presenter;

class SliderPresenter extends Presenter
{
    public function video()
    {

        return str_replace('\\','/',asset(Constant::SLIDERS_FILE_PATH . DIRECTORY_SEPARATOR . $this->entity->name));
    }

    public function status()
    {

        if ($this->entity->status == Constant::ACTIVE) {
            return " <div class='badge badge-light-success'>فعال</div>";
        } elseif ($this->entity->status == Constant::IN_ACTIVE) {
            return "  <div class='badge badge-light-danger'>غیر فعال</div>";
        }
    }

    public function getType()
    {
        if ($this->entity->type == Constant::IMAGE) {
            return " <div class='badge badge-light-success'>عکس</div>";
        } elseif ($this->entity->type == Constant::VIDEO) {
            return "  <div class='badge badge-light-danger'>ویدیو </div>";
        }
    }
}
