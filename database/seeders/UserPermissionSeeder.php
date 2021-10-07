<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UserPermission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'organization-list',
           'organization-create',
           'organization-edit',
           'organization-delete',
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',
        ];
     
        foreach ($permissions as $permission) {
             UserPermission::create(['permission' => $permission]);
        }
    }
}
