<?php

namespace App\Http\Resources;

use App\Constants\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category' => $this->categoryData($this->category),
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'price' => $this->price,
            'discount_percent' => $this->discount_percent,
            'quantity' => $this->quantity,
            'image' => $this->apiPresent()->image,
            'image_alt' => $this->image_alt,
            'discount_status' => $this->discount_status,
            'attributes' => ProductAttributesResource::collection($this->attributes) ,
            'gallery' => $this->filesResource($this->files),
            'comments' => CommentResource::collection($this->comments->where('status',Constant::PUBLISHED)),
            'meta_title' => strip_tags($this->meta_title),
            'meta_description' => strip_tags($this->meta_description),
            'canonical_url' => $this->canonical_url,
            'category_name' => $this->category->title,
            'category_slug' => $this->category->slug,
        ];
    }

    private function filesResource($allFiles)
    {

        $files =[];
        foreach ($allFiles as $file){
            $files[] = [
                'id' => $file->id,
                'file_name' => asset(Constant::PRODUCT_GALLERY_PATH.$file->name),
                'type' => $file->type,
                'link' => $file->link,
                'alt' => $file->alt
            ];
        }
        return $files;
    }

    private function categoryData($category)
    {
        return [
            'id' => $category->id,
            'parent_id' => $category->parent_id,
            'title' => $category->title,
            'slug' => $category->slug,
            'image' => $category->apiPresent()->image,
            'image_alt' => $category->image_alt,
            'meta_title' => strip_tags($category->meta_title),
            'meta_description' => strip_tags($category->meta_description),
            'canonical_url' => $category->canonical_url,
        ];
    }
}
