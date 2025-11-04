<?php

namespace Database\Seeders;

use App\Constants\PermissionConstant;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->refresh_permissions();

        $role = Role::create([
            'name' => 'super_admin' ,
            'persian_name' => 'ادمین اصلی',
        ]);
        $role->givePermissionTo(Permission::all());

        $admin = Admin::first();

        $admin->syncRoles($role);
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
    }
    private function isExistPermission(string $permission)
    {
        return (Permission::whereName($permission)->exists());
    }
}
