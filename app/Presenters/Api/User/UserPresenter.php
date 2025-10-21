<?php

namespace App\Presenters\Api\User;

use App\Constants\Constant;
use App\Presenters\Contracts\Presenter;

class UserPresenter extends Presenter
{

    public function fullName()
    {
        return $this->entity->first_name . ' ' . $this->entity->last_name;
    }

    public function avatar()
    {
        if (is_null($this->entity->avatar) || $this->entity->avatar == "") {
            return null;
        }
        return str_replace('\\', '/', asset(Constant::USERS_AVATAR_PATH . DIRECTORY_SEPARATOR . $this->entity->avatar));
    }


}
