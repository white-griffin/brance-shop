<?php

namespace App\Http\Controllers\Api;

use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\InstagramPostsResource;
use App\Models\InstagramPost;
use Illuminate\Http\Request;

class InstagramPostController extends Controller
{
    public function list()
    {
        $posts = InstagramPostsResource::collection(
            InstagramPost::where('status',Constant::ACTIVE)->get()
        );
        return ApiResponse::Success('',$posts);
    }
}
