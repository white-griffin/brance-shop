<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function list()
    {
        $employees = EmployeeResource::collection(
            Employee::all()
        );

        return ApiResponse::Success('',$employees);

    }
}
