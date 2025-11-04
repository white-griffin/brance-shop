<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\PermissionConstant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function all()
    {
        $permissions = Permission::all();


        return view('admin.acl.permissions.index',compact('permissions'));
    }


    public function refresh_permissions()
    {
        $groupPermissions = PermissionConstant::getDefaultPermissionScopes();


        foreach($groupPermissions as $permissions)
        {
            foreach($permissions as $permission)
            {
                if($this->isExistPermission($permission['name']))
                    continue;
                Permission::create($permission);
            }

        }
        return redirect()->route('admin.permissions.all')->with('updated-success','مجوز های پیش فرض سیستم با موفقیت ثبت شد');
    }


    private function isExistPermission(string $permission)
    {
        return (Permission::whereName($permission)->exists());
    }

    public function ajaxSearch()
    {

        $q = request('q');

        $permissions = Permission::select(['name', 'persian_name'])
            ->where('persian_name', 'like', "%$q%")
            ->get();
        $permissionArray = [];
        foreach ($permissions as $permission){
            $permissionArray[] = [
                'id' => $permission->name,
                'name' => $permission->persian_name
            ];
        }
        return response()->json(['data' => $permissionArray]);
    }
}
