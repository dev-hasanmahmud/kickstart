<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Traits\RedisCachable;

class PermissionRoleTableSeeder extends Seeder
{
    use RedisCachable;
    
    public function run()
    {
        $guestRole = Role::findOrFail(1);
        $adminRole = Role::findOrFail(2);

        $guestPermissions = Permission::whereIn('module_id', [1, 2])->pluck('id');
        $guestRole->permissions()->sync($guestPermissions);

        $adminPermissions = Permission::pluck('id');
        $adminRole->permissions()->sync($adminPermissions);

        $this->redisSet("role_permissions:1", $guestRole->permissions()->pluck('name')->toArray());
        $this->redisSet("role_permissions:2", $adminRole->permissions()->pluck('name')->toArray());
    }
}
