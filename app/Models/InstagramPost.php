<?php

namespace App\Models;

use App\Constants\Constant;
use App\Presenters\Api\InstagramPost\InstagramPostPresenter as ApiInstagramPostPresenter;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\InstagramPost\InstagramPostPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class InstagramPost extends Model
{
    use Presentable;

    protected $guarded = ['id'];

    protected $webPresenter = InstagramPostPresenter::class;
    protected $apiPresenter = ApiInstagramPostPresenter::class;


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
