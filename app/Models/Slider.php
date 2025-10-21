<?php

namespace App\Models;

use App\Constants\Constant;
use App\Presenters\Api\Slider\SliderPresenter as ApiSliderPresenter;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\Slider\SliderPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Slider extends Model
{
    use Presentable;

    protected $guarded = ['id'];

    protected $webPresenter = SliderPresenter::class;
    protected $apiPresenter = ApiSliderPresenter::class;


    public static function getFileType(UploadedFile $uploadedFile)
    {

        if (!in_array($uploadedFile->getClientMimeType(), Constant::WHITE_MIME_TYPE_LIST))
            return null ;

        return [
            'image/jpeg' => Constant::IMAGE,
            'image/png' => Constant::IMAGE,
            'image/jpg' => Constant::IMAGE,
            'image/gif' => Constant::GIF,
            'audio/mpeg' => Constant::SOUND,
            'video/mp4' => Constant::VIDEO,

        ][$uploadedFile->getClientMimeType()];

    }
}
