<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function list()
    {
        $sliders = Slider::all();
        return view('admin.sliders.list',compact('sliders'));
    }

    public function store()
    {
        DB::beginTransaction();
        try {

            $sliderData = $this->getSliderData();
            $slider = Slider::create($sliderData);
            DB::commit();
            ApiResponse::Success('عملیات موفق');
        }catch (\Exception $e){
            DB::rollBack();
            ApiResponse::Fail(500,'خطا در عملیات');
        }
    }

    public function update(Slider $slider)
    {
        DB::beginTransaction();
        try {
            $sliderData = $this->getSliderData();
            $slider->update($sliderData);
            DB::commit();
            return redirect()->route('admin.sliders.list')->with('success', 'عملیات شما با موفقیت انجام شد');
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'خطا در عملیات');
        }
    }

    public function delete(Slider $slider)
    {
        $slider->delete();
        return redirect()->back()->with('delete', 'عملیات شما با موفقیت انجام شد');
    }

    public function deleteSliderByName()
    {
        $gallery = Slider::whereName(\request('name'))->first();
        $gallery->delete();
        ApiResponse::Success('عملیات موفق');
    }

    private function getSliderData()
    {
        $data = [
            'link' => request('link'),
            'title' => request('title'),
            'type' => 'image'
        ];

        if (request()->hasFile('file')) {
            $data['name'] = $this->uploadFile(request()->file('file'), Constant::SLIDERS_FILE_PATH);
        }

        return $data;
    }
}
