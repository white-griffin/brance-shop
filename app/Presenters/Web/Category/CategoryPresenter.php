<?php


namespace App\Presenters\Web\Category;


use App\Constants\Constant;
use App\Presenters\Contracts\Presenter;

class CategoryPresenter extends Presenter
{
    public function image()
    {

        if (is_null($this->entity->image) || $this->entity->image == "") {
            return asset('admin-assets/media/avatars/blank.png');
        }
        return str_replace('\\', '/', asset(Constant::CATEGORY_IMAGE_PATH . DIRECTORY_SEPARATOR . $this->entity->image));
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

    public function type()
    {

        if (!is_null($this->entity->type) ) {
            return "<span class='badge badge-light-primary'>" . Constant::getCategoryTypes($this->entity->type) . "</span>";
        }
        return null;
    }
    public function access()
    {

        if (!is_null($this->entity->private_access) && $this->entity->private_access == Constant::FALSE) {
            return "<span class='badge badge-light-warning'>" . Constant::getCategoryAccess($this->entity->private_access) . "</span>";
        } elseif ($this->entity->private_access == Constant::TRUE) {
            return "<span class='badge badge-light-info'>" . Constant::getCategoryAccess($this->entity->private_access) . "</span > ";
        }elseif ($this->entity->private_access == Constant::ALL) {
            return "<span class='badge badge-light-success'>" . Constant::getCategoryAccess($this->entity->private_access) . "</span > ";
        }
        return null;
    }




}
