<?php

namespace App\Http\Resources;

use App\Constants\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TorobProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "page_unique" => (string)$this->id,
            "page_url" => 'https://magrico.ir/single/'.$this->slug,
            "product_group_id" => (string)$this->category->id,
            "title" => $this->title,
            "current_price" => (int)$this->price,
            "availability" => $this->status == Constant::ACTIVE,
            "category_name" => $this->category->title,
            "image_links" => $this->filesResource($this->apiPresent()->image,$this->files),
            "spec" => $this->getAttributes($this->attributes),
            "date_added" => $this->created_at->setTimezone('Asia/Tehran')->format('Y-m-d\TH:i:sP'),
            "date_updated" => $this->updated_at->setTimezone('Asia/Tehran')->format('Y-m-d\TH:i:sP'),
            "seller_city" => "مشهد"

        ];
    }


    private function filesResource($mainImage,$allFiles)
    {

        $files = [
            $mainImage
        ];

        foreach ($allFiles as $file){
            $files[] = asset(Constant::PRODUCT_GALLERY_PATH.$file->name);
        }
        return $files;
    }

    private function getAttributes($allAttributes){
        $attributes = [];
        foreach ($allAttributes as $attribute ){
            $attributes[$attribute->key] = $attribute->value;
        }
        return empty($attributes) ? new \stdClass() : $attributes;
    }

}
