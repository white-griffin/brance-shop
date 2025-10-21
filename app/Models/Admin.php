<?php

namespace App\Models;

use App\Filters\Contracts\Filterable;
use App\Presenters\Api\Admin\AdminPresenter as ApiAdminPresenter;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\Admin\AdminPresenter;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Presentable,HasRoles,HasPermissions,Filterable;
    protected $guarded=['id'];
    protected $webPresenter = AdminPresenter::class;
    protected $apiPresenter = ApiAdminPresenter::class;
}
