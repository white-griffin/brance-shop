<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\{CommentResource, ProductAttributesResource, ProductResource};
use App\Models\{Category, Comment, Product};
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
        $product = ProductResource::make(Product::findOrFail(\request('product_id')));

        return ApiResponse::Success('',$product);
    }

    public function detail($slug)
    {
        $product = ProductResource::make(Product::where('slug',$slug)->first());

        return ApiResponse::Success('',$product);
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


}
