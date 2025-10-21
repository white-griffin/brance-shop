<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Filters\BlogsFilter;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function list()
    {
        $blogs = Blog::filter(new BlogsFilter())
            ->orderby('created_at','ASC')
            ->paginate()
            ->withQueryString();
        $statuses = Constant::getBlogStatusesView();
        return view('admin.blog.list',compact('blogs','statuses'));
    }

    public function create()
    {
        $statuses = Constant::getBlogStatusesView();
        return view('admin.blog.create',compact('statuses'));
    }

    public function store()
    {
        $this->validateBlogData();
        DB::beginTransaction();
        try {
            $blogData = $this->getBlogData();
            $blog = Blog::create($blogData);
            DB::commit();
            return redirect()->route('admin.blogs.list')->with("success", "عملیات شما با موفقیت انجام شد ");

        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    public function edit(Blog $blog)
    {
        $statuses = Constant::getBlogStatusesView();
        return view('admin.blog.edit',compact('blog','statuses'));
    }

    public function update(Blog $blog)
    {
        $this->validateBlogData();
        DB::beginTransaction();
        try {
            $blogData = $this->getBlogData();
            $blog->update($blogData);
            DB::commit();
            return redirect()->route('admin.blogs.list')->with("success", "عملیات شما با موفقیت انجام شد ");

        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    public function delete(Blog $blog)
    {
        DB::beginTransaction();
        try {

            $blog->delete();
            DB::commit();
            return redirect()->route('admin.blogs.list')->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    private function getBlogData()
    {
        $data = [
            'author_id' => request('author'),
            'title' => request('title'),
            'status' => request('status'),
            'category_id' => request('category'),
            'content' => request('content'),
            'slug' => request('slug'),
            'meta_title' => request('meta_title'),
            'meta_description' => request('meta_description'),
            'canonical_url' => request('canonical_url'),
            'image_alt' => request('image_alt'),

        ];

        if (request()->hasFile('main_image')) {
            $data['main_image'] = $this->uploadFile(request()->file('main_image'), Constant::BLOG_MAIN_IMAGE_PATH);
        }

        return $data;
    }

    private function validateBlogData()
    {
        request()->validate([
            'category' => ['required'],
            'title' => ['required'],
            'content' => ['required'],
            'author' => ['required'],
        ], [
            "title.required" => "وارد کردن این فیلد الزامی است ",
            "content.required" => "وارد کردن این فیلد الزامی است ",
            "category.required" => "وارد کردن این فیلد الزامی است ",
            "author.required" => "وارد کردن این فیلد الزامی است ",

        ]);
    }

    public function searchBlogCategoriesWithAjax()
    {
        $q = request('q');
        $categories = Category::where('type',Constant::BLOG)
            ->select('parent_id','id','title as name')
            ->where('title', 'like', "%$q%")
            ->get();

        return response()->json(['data' => $categories]);
    }

	public function uploadCkImages(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ckeditor'), $filename);

            $url = asset('uploads/ckeditor/' . $filename);

            // ✅ خروجی صحیح برای CKEditor5
            return response()->json([
                'url' => $url, // برای مرورگرهایی که این نیاز دارند
                'uploaded' => true,
                'default' => $url // این قسمت برای imageUpload در CKEditor5 لازمه
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => ['message' => 'فایلی ارسال نشده است']
        ]);
    }
}
