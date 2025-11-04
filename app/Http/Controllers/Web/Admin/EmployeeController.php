<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Exception;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function list()
    {
        $employees = Employee::all();
        return view('admin.employees.list',compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store()
    {
        DB::beginTransaction();
        try {
            $employeeData = $this->getEmployeeData();
            $employee = Employee::create($employeeData);
            DB::commit();
            return redirect()->route('admin.employees.list')->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit',compact('employee'));
    }

    public function update(Employee $employee)
    {
        DB::beginTransaction();
        try {
            $employeeData = $this->getEmployeeData();
            $employee = $employee->update($employeeData);
            DB::commit();
            return redirect()->route('admin.employees.list')->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    public function delete(Employee $employee)
    {
        DB::beginTransaction();
        try {

            $employee->delete();
            DB::commit();
            return redirect()->route('admin.employees.list')->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    private function getEmployeeData()
    {
        $data = [
            'title' => request('title'),
            'description' => request('description'),
			'job_position' => request('job_position'),
            'social_links' => json_encode(\request('socials'))
        ];

        if (request()->hasFile('image')) {
            $data['image'] = $this->uploadFile(request()->file('image'), Constant::EMPLOYEE_IMAGE_PATH);
        }

        return $data;
    }
}
