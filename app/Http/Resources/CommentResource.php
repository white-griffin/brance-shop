<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->user->webPresent()->fullName,
            'text' => $this->text,
            'admin_reply' => !is_null($this->adminReply) ? $this->getAdminReplyData($this->adminReply) : null
        ];
    }

    private function getAdminReplyData($comment)
    {

        return [
            'admin' => $comment->admin->webPresent()->fullName,
            'text' => $comment->text
        ];
    }
}
