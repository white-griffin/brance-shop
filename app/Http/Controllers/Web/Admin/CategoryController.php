<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Filters\CategoriesFilter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function productCategories()
    {
        $categories = Category::filter(new CategoriesFilter())
            ->where('type',Constant::PRODUCT)
            ->orderby('created_at','ASC')
            ->paginate()
            ->withQueryString();
        $activityStatuses = Constant::getStatusesViewer();

        return view('admin.categories.list',compact('categories','activityStatuses'));
    }

    public function blogCategories()
    {
        $categories = Category::filter(new CategoriesFilter())
            ->where('type',Constant::BLOG)
            ->orderby('created_at','ASC')
            ->paginate()
            ->withQueryString();
        $activityStatuses = Constant::getStatusesViewer();
        return view('admin.categories.list',compact('categories','activityStatuses'));
    }

    public function create()
    {
        $activityStatuses = Constant::getStatusesViewer();
        $categoryTypes = Constant::getCategoryTypesViewer();
        return view('admin.categories.create',compact('activityStatuses','categoryTypes'));
    }

    public function store()
    {
        $this->validateCategory();

        DB::beginTransaction();
        try {
            $categoryData = $this->getCategoryData();
            $category = Category::create($categoryData);
            DB::commit();
            request('type') == Constant::BLOG ? $route = 'admin.categories.blog-categories' : $route = 'admin.categories.product-categories';
            return redirect()->route($route)->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    public function edit(Category $category)
    {
        $activityStatuses = Constant::getStatusesViewer();
        $categoryTypes = Constant::getCategoryTypesViewer();
        return view('admin.categories.edit',compact('category','activityStatuses','categoryTypes'));
    }

    public function update(Category $category)
    {
        $this->validateCategory();

        DB::beginTransaction();
        try {
            $categoryData = $this->getCategoryData();
            $category->update($categoryData);
            DB::commit();
            request('type') == Constant::BLOG ? $route = 'admin.categories.blog-categories' : $route = 'admin.categories.product-categories';
            return redirect()->route($route)->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    public function delete(Category $category)
    {
        DB::beginTransaction();
        try {
            $category->type == Constant::BLOG ? $route = 'admin.categories.blog-categories' : $route = 'categories.product-categories';
            $category->delete();
            DB::commit();
            return redirect()->route($route)->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    private function validateCategory()
    {
        request()->validate([
            'title' => ['required'],
            'status' => ['required'],
        ], [
            "title.required" => "وارد کردن این فیلد الزامی است ",
            "status.required" => "وارد کردن این فیلد الزامی است ",
        ]);
    }

    private function getCategoryData()
    {
        $data = [
            'title' => request('title'),
            'description' => request('description'),
            'slug' => request('slug'),
            'status' => request('status'),
            'parent_id' => request('parent_category'),
            'type' => request('type'),
            'meta_title' => request('meta_title'),
            'meta_description' => request('meta_description'),
            'canonical_url' => request('canonical_url'),
            'image_alt' => request('image_alt'),
        ];

        if (request()->hasFile('image')) {
            $data['image'] = $this->uploadFile(request()->file('image'), Constant::CATEGORY_IMAGE_PATH);
        }

        return $data;
    }

    public function searchWithAjax()
    {
        $q = request('q');
        $categories = Category::where('type',request('type'))
            ->select('parent_id','id','title as name')
            ->where('title', 'like', "%$q%")
            ->when(request()->has('cat_id'),function ($query){
                $query->where('id','!=',request('cat_id'));
            })
            ->get();

        return response()->json(['data' => $categories]);
    }


}
