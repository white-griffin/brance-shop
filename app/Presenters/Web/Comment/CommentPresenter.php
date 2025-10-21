<?php

namespace App\Presenters\Web\Comment;

use App\Constants\Constant;
use App\Presenters\Contracts\Presenter;

class CommentPresenter extends Presenter
{
    public function commentableTitle()
    {
        return $this->entity->commentable->title;
    }

    public function commentableType()
    {

        return Constant::getMorphClass($this->entity->commentable_type);
    }

    public function user()
    {
        if (!is_null($this->entity->user)){
             return $this->entity->user->webPresent()->fullName;
        }else{
            return '';
        }
    }

    public function admin()
    {
        if (!is_null($this->entity->admin)){
            return $this->entity->admin->webPresent()->fullName;
        }else{
            return '';
        }
    }

    public function status()
    {
        if (!is_null($this->entity->status) && $this->entity->status == Constant::PUBLISHED) {
            return "<span class='badge badge-light-success'>" . Constant::getStatusComments($this->entity->status) . "</span>";
        }
        elseif ($this->entity->status == Constant::REJECTED) {
            return "<span class='badge badge-light-danger'>" . Constant::getStatusComments($this->entity->status) . "</span > ";
        }
        elseif ($this->entity->status == Constant::PENDING) {
            return "<span class='badge badge-light-warning'>" . Constant::getStatusComments($this->entity->status) . "</span > ";
        }
        return null;
    }
}
