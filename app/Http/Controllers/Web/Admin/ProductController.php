<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Filters\ProductFilter;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use App\Models\ProductAttribute;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::filter(new ProductFilter())
            ->orderby('created_at','ASC')
            ->paginate()
            ->withQueryString();
        $activityStatuses = Constant::getStatusesViewer();
        return view('admin.products.list',compact('products','activityStatuses'));
    }

    public function create()
    {
        $activityStatuses = Constant::getStatusesViewer();
        return view('admin.products.create',compact('activityStatuses'));
    }

    public function store()
    {


        $this->validateProduct();

        DB::beginTransaction();
        try {
            $productData = $this->getProductData();
            $product = Product::create($productData);
            DB::commit();
            return redirect()->route('admin.products.edit',$product)->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    public function edit(Product $product)
    {
        $activityStatuses = Constant::getStatusesViewer();

        return view('admin.products.edit',compact('product','activityStatuses'));
    }

    public function update(Product $product)
    {

        $this->validateProduct();

        DB::beginTransaction();
        try {
            $productData = $this->getProductData();
            $product->update($productData);
            DB::commit();
            return redirect()->route('admin.products.edit',$product)->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    public function delete(Product $product)
    {
        DB::beginTransaction();
        try {

            $product->delete();
            DB::commit();
            return redirect()->route('admin.products.list')->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    private function validateProduct()
    {
        request()->validate([
            'category' => ['required'],
            'title' => ['required'],
            'price' => ['required'],
        ], [
            "title.required" => "وارد کردن این فیلد الزامی است ",
            "price.required" => "وارد کردن این فیلد الزامی است ",
            "category.required" => "وارد کردن این فیلد الزامی است ",

        ]);
    }

    private function getProductData()
    {
        $data = [
            'title' => request('title'),
            'description' => request('description'),
            'slug' => request('slug'),
            'status' => request('status'),
            'category_id' => request('category'),
            'price' => request('price'),
            'discount_percent' => request()->has('discount_percent') ? request('discount_percent') : 0,
            'quantity' => request('quantity'),
            'discount_status' => request('discount_status'),
            'special_status' => request('special_status'),
            'product_code' => request('product_code'),
            'meta_title' => request('meta_title'),
            'meta_description' => request('meta_description'),
            'canonical_url' => request('canonical_url'),
            'image_alt' => request('image_alt'),
        ];

        if (request()->hasFile('image')) {
            $data['image'] = $this->uploadFile(request()->file('image'), Constant::PRODUCT_IMAGE_PATH);
        }

        return $data;
    }

    public function gallery(Product $product)
    {
        $files = $product->files;
        return view('admin.products.gallery',compact('product','files'));
    }

    public function uploadGallery(Product $product)
    {
        $type = File::getFileType(request()->file('file'));
        $file = new File;
        $file->name = $this->uploadFile(request()->file('file'), Constant::PRODUCT_GALLERY_PATH);
        $file->type = $type;
        $file->length = request('duration');
        $file->link = request('link');
        $file->alt = request('alt');
        $result = $product->files()->saveMany([$file]);

    }

    public function deleteGallery(File $gallery)
    {

        $gallery->delete();
        return redirect()->back()->with('delete', 'عملیات شما با موفقیت انجام شد');
    }

    public function deleteGalleryByName()
    {
        $gallery = File::whereName(request('name'))->first();
        $gallery->delete();
        ApiResponse::Success('عملیات موفق');
    }

    public function attributes(Product $product)
    {
        $attributes = $product->attributes;
        return view('admin.products.attributes',compact('product','attributes'));
    }

    public function storeAttribute(Product $product)
    {

        DB::beginTransaction();
        try {

            ProductAttribute::create([
                'product_id' => $product->id,
                'key' => request('key'),
                'value' => request('value')
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'عملیات  با موفقیت انجام شد');
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'خطا در انجام عملیات');

        }


    }

    public function deleteAttribute(ProductAttribute $attribute)
    {

        $attribute->delete();
        return redirect()->back()->with('delete', 'عملیات با موفقیت انجام شد');
    }


    public function searchProductCategoriesWithAjax()
    {
        $q = request('q');
        $categories = Category::where('type',Constant::PRODUCT)
            ->select('parent_id','id','title as name')
            ->where('title', 'like', "%$q%")
            ->get();

        return response()->json(['data' => $categories]);
    }
}
