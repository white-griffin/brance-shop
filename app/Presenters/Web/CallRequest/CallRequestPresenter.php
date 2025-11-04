<?php

namespace App\Presenters\Web\CallRequest;

use App\Constants\Constant;
use App\Presenters\Contracts\Presenter;

class CallRequestPresenter extends Presenter
{

    public function status(): ?string
    {
        if ($this->entity->status == Constant::PENDING) {
            return " <div class='badge badge-light-warning'>در انتظار</div>";
        } elseif ($this->entity->status == Constant::CONFIRMED) {
            return "  <div class='badge badge-light-success'>تایید شده</div>";
        }elseif ($this->entity->status == Constant::REJECTED) {
            return "  <div class='badge badge-light-danger'>رد شده</div>";
        }
        return null;
    }

    public function user()
    {
        if (!is_null($this->entity->client_first_name)&&!is_null($this->entity->client_last_name)) {
            return $this->entity->client_first_name . ' ' . $this->entity->client_last_name;
        }
        return null;

    }
}
