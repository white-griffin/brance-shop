<?php

namespace App\Models;

use App\Filters\Contracts\Filterable;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\CallRequest\CallRequestPresenter;
use Illuminate\Database\Eloquent\Model;

class CallRequest extends Model
{
    use Presentable,Filterable;
    protected $guarded=['id'];

    protected string $webPresenter = CallRequestPresenter::class;
}
