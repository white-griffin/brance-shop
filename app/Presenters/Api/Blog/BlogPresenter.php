<?php

namespace App\Presenters\Api\Blog;

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


}
