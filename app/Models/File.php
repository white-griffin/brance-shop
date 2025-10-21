<?php

namespace App\Models;

use App\Constants\Constant;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\File\FilePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class File extends Model
{
    use Presentable;

    protected $guarded = ['id'];

    protected $webPresenter = FilePresenter::class;


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
