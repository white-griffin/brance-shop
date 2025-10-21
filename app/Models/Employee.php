<?php

namespace App\Models;

use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\Employee\EmployeePresenter;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use Presentable;
    protected $guarded = ['id'];
    protected $webPresenter = EmployeePresenter::class;

}
