<?php

namespace App\Presenters\Api\User;

use App\Presenters\Contracts\Presenter;

class LevelUserPresenter extends Presenter
{
    public function levelParentTitle()
    {
        return $this->entity->level->parent->app_title;
    }

    public function levelParentId()
    {
        return $this->entity->level->parent->id;
    }

    public function parentAccentTitle()
    {
        return $this->entity->level->accent->app_title;
    }
    public function parentAccentId()
    {
        return $this->entity->level->accent->id;
    }
}
