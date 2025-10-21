<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;

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
            'meta_title' => strip_tags($this->meta_title),
            'meta_description' => strip_tags($this->meta_description),
            'canonical_url' => $this->canonical_url,
            'parent_category_slug' => isset($category->parent_id) && $category->parent_id != null ? $category->parent->slug : null
        ];
    }

}
