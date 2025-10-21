<?php


namespace App\Presenters\Web\User;


use App\Constants\Constant;
use App\Helpers\Format\Date;
use App\Presenters\Contracts\Presenter;

class UserPresenter extends Presenter
{
    public function avatar()
    {
        if (is_null($this->entity->avatar) || $this->entity->avatar == "") {
            return asset('admin-assets/media/avatars/admin-profile.png');
        }
        return str_replace('\\', '/', asset(Constant::USERS_AVATAR_PATH . DIRECTORY_SEPARATOR . $this->entity->avatar));
    }

    public function status()
    {

        if ($this->entity->status == "active") {
            return " <div class='badge badge-light-success'>فعال</div>";
        } elseif ($this->entity->status == "in-active") {
            return "  <div class='badge badge-light-danger'>غیر فعال</div>";
        }
    }

    public function has_call_status()
    {

        if ($this->entity->has_call_status == "active") {
            return " <div class='badge badge-light-success'>فعال</div>";
        } elseif ($this->entity->has_call_status == "in-active") {
            return "  <div class='badge badge-light-danger'>غیر فعال</div>";
        }
    }

    public function fullName()
    {
        return $this->entity->first_name . ' ' . $this->entity->last_name;
    }

    public function mobile()
    {

        return $this->entity->mobile;
    }


    public function country()
    {
        return $this->entity->country->fa_name;
    }

    public function registerDate()
    {
        return Date::toJalaliFormat($this->entity->created_at);
    }

    public function birthDate()
    {
        return Date::toJalaliFormat($this->entity->birth_date);
    }
}
