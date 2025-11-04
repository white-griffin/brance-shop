<?php

namespace App\Http\Controllers\Api;

use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function list()
    {
        $sliders = SliderResource::collection(
          Slider::where('status',Constant::ACTIVE)->get()
        );

        return ApiResponse::Success('',$sliders);
    }
}
