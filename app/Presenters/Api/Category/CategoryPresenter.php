<?php

namespace App\Presenters\Api\Category;

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

}
