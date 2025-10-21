<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Filters\AdminsFilter;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::filter(new AdminsFilter())->paginate()
            ->withQueryString();
        return view('admin.admins.all', compact('admins'));
    }

    public function create()
    {

        $activityStatuses = Constant::getStatusesViewer();
        return view('admin.admins.create', compact('activityStatuses'));
    }

    public function edit(Admin $admin)
    {
        $adminRolesArray = [];
        foreach ($admin->roles()->get() as $role){
            $adminRolesArray[] = [
                'id' => $role->name,
                'title' => $role->persian_name
            ];
        }

        $adminPermissionsArray = [];
        foreach ($admin->permissions()->get() as $permission){
            $adminPermissionsArray[] = [
                'id' => $permission->name,
                'title' => $permission->persian_name
            ];
        }
        $activityStatuses = Constant::getStatusesViewer();
        return view('admin.admins.edit', compact('admin', 'activityStatuses','adminPermissionsArray','adminRolesArray'));
    }

    public function store()
    {

        $this->validateStore();

        DB::beginTransaction();
        try {
            $data = $this->getData();
            $admin = Admin::create($data);

            if (request('roles'))
                $admin->syncRoles(request('roles'));
            if (request('permissions'))
                $admin->syncPermissions(request('permissions'));

            DB::commit();
            return redirect()->route('admin.admins.all')->with("success", "عملیات شما با موفقیت انجام شد ");

        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','خطا در عملیات');
        }

    }

    public function update(Admin $admin)
    {

        $this->validateUpdate();

        DB::beginTransaction();
        try {
            $data = $this->getData();
            $admin->update($data);
            if (request('roles'))
                $admin->syncRoles(request('roles'));
            if (request('permissions'))
                $admin->syncPermissions(request('permissions'));
            DB::commit();
            return redirect()->route('admin.admins.all')->with("success", "ویرایش شما با موفقیت انجام شد  ");

        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','خطا در بروز رسانی اطلاعات');
        }


    }
    private function validateStore()
    {
        request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'mobile' => ['required'],
            'email' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'avatar' => ['required'],

        ], [
            "first_name.required" => "وارد کردن این فیلد الزامیاست ",
            "last_name.required" => "وارد کردن این فیلد الزامیاست ",
            "mobile.required" => "وارد کردن این فیلد الزامیاست ",
            "username.required" => "وارد کردن این فیلد الزامیاست ",
            "password.required" => "وارد کردن این فیلد الزامیاست ",
            "email.required" => "وارد کردن این فیلد الزامیاست ",
            "avatar.required" => "وارد کردن این فیلد الزامیاست ",

        ]);

    }
    private function validateUpdate()
    {
        request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'mobile' => ['required'],
            'email' => ['required'],
            'username' => ['required'],

        ], [
            "first_name.required" => "وارد کردن این فیلد الزامیاست ",
            "last_name.required" => "وارد کردن این فیلد الزامیاست ",
            "mobile.required" => "وارد کردن این فیلد الزامیاست ",
            "username.required" => "وارد کردن این فیلد الزامیاست ",
            "email.required" => "وارد کردن این فیلد الزامیاست ",

        ]);

    }
    private function getData(): array
    {
        $data = [
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'mobile' => request('mobile'),
            'email' => request('email'),
            'username' => request('username'),
            'status' => request('status'),
        ];
        if (request()->hasFile('avatar')) {
            $data['avatar'] = $this->uploadFile(request()->file('avatar'), Constant::ADMINS_IMAGE_PATH);
        }
        if (request()->has('password')) {
            $data['password'] = Hash::make(request('password'));
        }
        return $data;
    }

    public function searchWithAjax()
    {
        $q = request('q');

        $users = Admin::select('id', DB::raw("CONCAT(admins.first_name,' ',admins.last_name) as name"))
            ->where('last_name', 'like', "%$q%")
            ->orWhere('first_name', 'like', "%$q%")
            ->get();
        if (request('null_value')){

            $users->push(['id' => '0' , 'name' => 'بدون مدیر']);

        }
        return response()->json(['data' => $users]);
    }

    public function permissions(Admin $admin)
    {
        $permissions = $admin->permissions;
        return view('admin.admins.permissions', compact('admin', 'permissions'));
    }
    public function roles(Admin $admin)
    {
        $roles = $admin->roles;
        return view('admin.admins.roles', compact('admin', 'roles'));
    }

}
