<?php

namespace App\Models;

use App\Filters\Contracts\Filterable;
use App\Presenters\Api\Category\CategoryPresenter as ApiCategoryPresenter;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\Category\CategoryPresenter;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Presentable,Filterable;
    protected $guarded = ['id'];
    protected $webPresenter = CategoryPresenter::class;
    protected $apiPresenter = ApiCategoryPresenter::class;

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function allCategoryIds()
    {
        $ids = collect([$this->id]);

        foreach ($this->subCategories as $child) {
            $ids = $ids->merge($child->allCategoryIds());
        }

        return $ids;
    }


}
