<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\PermissionConstant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Mockery\Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function all(Role $role)
    {
        $roles = Role::all();


        return view('admin.acl.roles.index',compact('roles'));
    }
    public function create()
    {
        $allPermissions = Permission::all()->groupBy('entity');
        $groupNamePermissions = PermissionConstant::getGropNamePermissions();
        return view('admin.acl.roles.create',compact('allPermissions','groupNamePermissions'));
    }
    public function store(Request $request)
    {
        $this->validateStoreRoleForm($request);
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->input('name') ,
                'persian_name' => $request->input('persian_name'),
            ]);
            $role->givePermissionTo($request->input('permissions'));
            DB::commit();
            return redirect()->route('admin.roles.all')->with(['success'=>'نقش مورد نظر با موفقیت  ثبت شد ']);
        }catch (Exception $e){
            DB::rollBack();
            return back()->with(['error'=>'خطا در ثبت نقش ']);

        }


    }
    public function delete(Role $role)
    {
        $role->syncPermissions();
        $result = $role->delete();
        if($result)
        {
            return redirect()->back()->with(['role.deleted' => 'نقش مورد نظر با موفقیت حذف شد']);
        }
    }
    public function edit(Role $role)

    {

        $allPermissions = Permission::all()->groupBy('entity');

        $groupNamePermissions =PermissionConstant::getGropNamePermissions();

        $permissionsIDs = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::all();

        return view('admin.acl.roles.edit',compact('role','permissionsIDs','permissions','groupNamePermissions','allPermissions'));
    }
    public function update(Role $role , Request $request)
    {
        $this->validateUpdateForm($request,$role);
        $result = $role->update([
            'name' => $request->input('name'),
            'persian_name' => $request->input('persian_name'),
        ]);

        if($result)
        {
            $role->syncPermissions($request->input('permissions'));
            return redirect()->route('admin.roles.all')->with(['role.updated' => 'نقش مورد نظر با موفقیت ویرایش شد']);
        }
    }
    public function permissions(Role $role)
    {
        $permissions=$role->permissions()->get();

        return view('admin.acl.roles.permissions',compact('permissions','role'));
    }
    public function ajaxSearch()
    {

        $q = request('q');

        $roles = Role::select(['persian_name','name'])
            ->where('persian_name', 'like', "%$q%")
            ->get();
        $rolesArray = [];
        foreach ($roles as $role){
            $rolesArray[] = [
                'id' => $role->name,
                'name' => $role->persian_name
            ];
        }
        return response()->json(['data' => $rolesArray]);
    }
    private function validateStoreRoleForm(Request $request)
    {
        $request->validate([
            'name' => ['required','unique:roles'],
            'persian_name' => ['required'],
            'permissions' => ['required']
        ]);
    }
    private function validateUpdateForm(Request $request,Role $role)
    {

        $request->validate([
            'name' => ['required',Rule::unique('roles','name')->ignore($role->id)],
            'persian_name' => ['required',Rule::unique('roles','persian_name')->ignore($role->id)],
            'permissions' => ['required'],
        ]);
    }
}
