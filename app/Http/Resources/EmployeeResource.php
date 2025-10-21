<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
			'job_position' => $this->job_position,
            'description' => $this->description,
            'image' => $this->webPresent()->image,
            'social_lonks' => !empty($this->social_links) ? json_decode($this->social_links, true) : []
        ];
    }
}
