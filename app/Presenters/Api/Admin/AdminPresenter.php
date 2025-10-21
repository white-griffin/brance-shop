<?php

namespace App\Presenters\Api\Admin;

use App\Constants\Constant;
use App\Presenters\Contracts\Presenter;

class AdminPresenter extends Presenter
{
    public function fullName()
    {
        return $this->entity->first_name .' '. $this->entity->last_name;
    }

    public function avatar()
    {
        if (is_null($this->entity->avatar) || $this->entity->avatar == "") {
            return asset('admin-assets/media/avatars/admin-profile.png');
        }
        return str_replace('\\','/',asset(Constant::ADMINS_IMAGE_PATH . DIRECTORY_SEPARATOR . $this->entity->image));
    }
}
