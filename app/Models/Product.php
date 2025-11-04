<?php

namespace App\Models;

use App\Filters\Contracts\Filterable;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\Product\ProductPresenter;
use App\Presenters\Api\Product\ProductPresenter as ApiProductPresenter;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Filterable,Presentable;
    protected $webPresenter = ProductPresenter::class;
    protected $apiPresenter = ApiProductPresenter::class;

    protected $guarded =['id'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class,'product_id');
    }

    public function files()
    {
        return $this->morphToMany(File::class, 'filable', 'filables');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
