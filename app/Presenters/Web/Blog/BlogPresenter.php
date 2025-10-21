<?php

namespace App\Presenters\Web\Blog;

use App\Constants\Constant;
use App\Presenters\Contracts\Presenter;

class BlogPresenter extends Presenter
{
    public function image()
    {

        if (is_null($this->entity->main_image) || $this->entity->main_image == "") {
            return asset('admin-assets/media/avatars/blank.png');
        }
        return str_replace('\\', '/', asset(Constant::BLOG_MAIN_IMAGE_PATH . DIRECTORY_SEPARATOR . $this->entity->main_image));
    }

    public function status()
    {
        if (!is_null($this->entity->status) && $this->entity->status == Constant::PUBLISHED) {
            return "<span class='badge badge-light-success'>" . Constant::getBlogStatuses($this->entity->status) . "</span>";
        } elseif ($this->entity->status == Constant::DRAFT) {
            return "<span class='badge badge-light-danger'>" . Constant::getBlogStatuses($this->entity->status) . "</span > ";
        }
        return null;
    }
}
