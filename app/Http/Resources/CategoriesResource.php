<?php

namespace App\Http\Resources;

use App\Helpers\Format\Date;
use Illuminate\Http\Request;
use App\Models\{Category, Product};
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'title' => $this->title,
			'description' => $this->description,
            'slug' => $this->slug,
            'image' => $this->apiPresent()->image,
            'image_alt' => $this->image_alt,
            'sub_categories' => CategoriesResource::collection(
                $this->subCategories
            ),
            'parent_category' => !is_null($this->parent)?
                $this->parentCategoryData($this->parent)
                : null,
            'meta_title' => strip_tags($this->meta_title),
            'meta_description' => strip_tags($this->meta_description),
            'canonical_url' => $this->canonical_url,
            'parent_category_slug' => isset($category->parent_id) && $category->parent_id != null ? $category->parent->slug : null,
            'update_date' => Date::toJalaliFormat($this->updated_at),
        ];
    }

     private function parentCategoryData($parent){
        return [
            'title' => $parent->title,
            'slug' => $parent->slug
        ];
    }

}
