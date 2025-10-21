<?php


namespace App\Presenters\Web\Admin;


use App\Constants\Constant;
use App\Presenters\Contracts\Presenter;

class AdminPresenter extends Presenter
{
    public function avatar()
    {
        if (is_null($this->entity->avatar) || $this->entity->avatar == "") {
            return asset('admin-assets/media/avatars/admin-profile.png');
        }
        return str_replace('\\','/',asset(Constant::ADMINS_IMAGE_PATH . DIRECTORY_SEPARATOR . $this->entity->avatar));
    }

    public function status()
    {

        if ($this->entity->status == "active") {
            return " <div class='badge badge-light-success'>فعال</div>";
        } elseif ($this->entity->status == "in-active") {
            return "  <div class='badge badge-light-danger'>غیر فعال</div>";
        }
    }

    public function fullName()
    {
        return $this->entity->first_name .' '. $this->entity->last_name;
    }

}
