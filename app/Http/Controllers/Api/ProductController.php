<?php

namespace App\Http\Controllers\Api;

use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ProductAttributesResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
    public function allProducts()
    {
        $products = ProductResource::collection(
            Product::where('status',Constant::ACTIVE)
                ->get()
        );

        return ApiResponse::Success('',$products);
    }

    public function list()
    {
        $category = Category::findOrFail(request('category_id'));
        $subCategories = Category::where('parent_id',$category->id)->get();
        $products = ProductResource::collection($category->products->where('status',Constant::ACTIVE));
        if(!is_null($subCategories)){
            foreach ($subCategories as $subCategory){
                $products = $products->merge(ProductResource::collection($subCategory->products->where('status',Constant::ACTIVE)));
            }
        }

        return ApiResponse::Success('',$products);
    }

    public function specialList()
    {
        $products = ProductResource::collection(
            Product::where('special_status',Constant::ACTIVE)
                ->where('status',Constant::ACTIVE)
                ->get()
        );

        return ApiResponse::Success('',$products);
    }

    public function discountList()
    {
        $products = ProductResource::collection(
            Product::where('discount_status',Constant::ACTIVE)
                ->where('status',Constant::ACTIVE)
                ->get()
        );

        return ApiResponse::Success('',$products);
    }

    public function single()
    {
        $product = Product::findOrFail(\request('product_id'));

        return ApiResponse::Success('',$this->singleProductResource($product));
    }

    public function detail($slug)
    {
        $product = Product::where('slug',$slug)->first();

        return ApiResponse::Success('',$this->singleProductResource($product));
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

    public function addComment()
    {
        $product = Product::findOrFail(request('product_id'));

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

    private function singleProductResource($product)
    {
        return [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'title' => $product->title,
            'description' => $product->description,
            'slug' => $product->slug,
            'price' => $product->price,
            'discount_percent' => $product->discount_percent,
            'quantity' => $product->quantity,
            'image' => $product->apiPresent()->image,
            'image_alt' => $product->image_alt,
            'discount_status' => $product->discount_status,
            'attributes' => ProductAttributesResource::collection($product->attributes) ,
            'gallery' => $this->filesResource($product->files),
            'comments' => CommentResource::collection($product->comments->where('status',Constant::PUBLISHED)),
            'meta_title' => strip_tags($product->meta_title),
            'meta_description' => strip_tags($product->meta_description),
            'canonical_url' => $product->canonical_url,
            'category_name' => $product->category->title,
            'category_slug' => $product->category->slug,
        ];
    }
}
