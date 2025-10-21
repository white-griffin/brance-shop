<?php

namespace App\Http\Controllers\Api;

use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CommentResource;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use App\Helpers\Format\Date;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BlogController extends Controller
{
    public function allBlogs()
    {
        $blogs = BlogResource::collection(
            Blog::where('status',Constant::PUBLISHED)
                ->orderBy('updated_at','desc')
                ->get()
        );

        return ApiResponse::Success('',$blogs);
    }

    public function list()
    {
        $blogs = BlogResource::collection(
            Blog::where('category_id',\request('category_id'))
            ->where('status',Constant::PUBLISHED)
            ->get()
        );

        return ApiResponse::Success('',$blogs);
    }

    public function single()
    {
        $blog = Blog::findOrFail(\request('blog_id'));

        return ApiResponse::Success('',$this->singleBlogResource($blog));
    }

    public function detail($slug)
    {
        $blog = Blog::where('slug',$slug)->first();

        return ApiResponse::Success('',$this->singleBlogResource($blog));
    }

    public function addComment()
    {
        $product = Blog::findOrFail(request('blog_id'));

        DB::beginTransaction();
        try {

            $comment = new Comment([
                'user_id' => request()->user()->id,
                'text' => request('text')
            ]);

            $product->comments()->save($comment);

            DB::commit();
            return ApiResponse::Success('نظر با موفقیت ثبت شد');
        }catch (\Exception $e){
            DB::rollBack();
            return ApiResponse::Fail(ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,'خطا در عملیات');
        }

    }

    private function singleBlogResource($blog)
    {
        return [
            'id' => $blog->id,
            'author' => $blog->author->apiPresent()->fullName,
            'category_id' => $blog->category_id,
            'title' => $blog->title,
            'content' => $blog->content,
            'image' => $blog->webPresent()->image,
            'image_alt' => $blog->image_alt,
            'slug' => $blog->slug,
            'comments' => CommentResource::collection($blog->comments->where('status',Constant::PUBLISHED)),
            'meta_title' => strip_tags($blog->meta_title),
            'meta_description' => strip_tags($blog->meta_description),
            'create_date' => Date::toJalaliFormat($blog->created_at),
            'update_date' => Date::toJalaliFormat($blog->updated_at),
            'canonical_url' => $blog->canonical_url,
        ];
    }
}
