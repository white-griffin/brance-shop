<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TorobProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;

class TorobApiController extends Controller
{
    public function list(Request $request)
    {

        // Check request parameters and get products accordingly
        switch(true) {

            case isset($request['page_urls']):
                $products = $this->getProductsBySlug($request['page_urls']);
                break;

            case isset($request['page_uniques']):
                $products = $this->getProductsByIds($request['page_uniques']);
                break;

            case isset($request['page']):
            if(!isset($request['sort'])) {
                return response()->json([
                    'error' => 'sort parameter is not provided'
                ], 400);
            }
            $products = $this->getProductsByPageNumber($request);
            break;

        }

        return $products;

    }

    private function getProductsBySlug($urls)
    {
        $slugs = [];
        foreach ($urls as $url) {
            $parts = explode('/', $url);
            $slug = end($parts);
            $slugs[] = $slug;
        }

        $products = Product::whereIn('slug', $slugs)->get();

        return $this->setResponse($products,1,count($products),1);
    }

    private function getProductsByIds($ids){
        $products = Product::whereIn('id', $ids)->get();
        return $this->setResponse($products,1,count($products),1);
    }

    private function getProductsByPageNumber($request){

        $products = Product::orderBy($request['sort'] == 'date_added_desc' ? 'created_at' : 'updated_at', 'desc')
        ->paginate(100, ['*'], 'page', $request['page']);
        return $this->setResponse($products->items(),$request['page'],Product::query()->count(),(Product::query()->count()/100)+1);
    }

    private function setResponse($products,$page_num,$total,$max_pages){

        return [
            "api_version" => "torob_api_v3",
            "current_page" => $page_num,
            "total" => (int)$total,
            "max_pages" => (int)$max_pages,
            "products" => TorobProductsResource::collection($products),
        ];
    }

}
