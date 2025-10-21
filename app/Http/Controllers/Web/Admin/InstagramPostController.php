<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\InstagramPost;
use Exception;
use Illuminate\Support\Facades\DB;

class InstagramPostController extends Controller
{
    public function list()
    {
        $sliders = InstagramPost::all();
        return view('admin.instagram-posts.list',compact('sliders'));
    }

    public function store()
    {

        ;
        DB::beginTransaction();
        try {
            $slider = new InstagramPost;
            $slider->name = $this->uploadFile(request()->file('file'), Constant::INSTAGRAM_POST_PATH);
            $slider->type = InstagramPost::getFileType(request()->file('file'));
            $slider->link = request('link');
            $slider->title = request('title');
            $slider->save();
            DB::commit();
            ApiResponse::Success('عملیات موفق');
        }catch (\Exception $e){
            DB::rollBack();

            ApiResponse::Fail(500,'خطا در عملیات');
        }
    }

    public function update(InstagramPost $post)
    {
        DB::beginTransaction();
        try {
            $postData = $this->getUpdatePostData();
            $post->update($postData);
            DB::commit();
            return redirect()->route('admin.instagram-posts.list')->with('success', 'عملیات شما با موفقیت انجام شد');
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'خطا در عملیات');
        }
    }

    public function delete(InstagramPost $slider)
    {
        $slider->delete();
        return redirect()->back()->with('delete', 'عملیات شما با موفقیت انجام شد');
    }

    public function deletePostByName()
    {
        $gallery = InstagramPost::whereName(\request('name'))->first();
        $gallery->delete();
        ApiResponse::Success('عملیات موفق');
    }

    private function getUpdatePostData()
    {
        $data = [
            'link' => request('link'),
            'title' => request('title')
        ];

        if (request()->hasFile('file')) {
            $data['name'] = $this->uploadFile(request()->file('file'), Constant::INSTAGRAM_POST_PATH);
        }

        return $data;
    }
}
