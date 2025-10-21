<?php

namespace App\Models;

use App\Filters\Contracts\Filterable;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\Blog\BlogPresenter;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use Filterable,Presentable;
    protected $webPresenter = BlogPresenter::class;
    protected $apiPresenter = BlogPresenter::class;

    protected $guarded =['id'];


    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function author()
    {
        return $this->belongsTo(Admin::class,'author_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
