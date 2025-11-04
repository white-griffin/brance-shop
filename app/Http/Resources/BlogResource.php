<?php

namespace App\Http\Resources;

use App\Constants\Constant;
use App\Helpers\Format\Date;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'author' => $this->author->apiPresent()->fullName,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->apiPresent()->image,
            'image_alt' => $this->image_alt,
            'slug' => $this->slug,
            'comments' => CommentResource::collection($this->comments->where('status',Constant::PUBLISHED)),
            'meta_title' => strip_tags($this->meta_title),
            'meta_description' => strip_tags($this->meta_description),
			'create_date' => Date::toJalaliFormat($this->created_at),
            'update_date' => Date::toJalaliFormat($this->updated_at),
            'canonical_url' => $this->canonical_url,
        ];
    }
}
