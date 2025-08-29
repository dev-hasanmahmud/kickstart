<?php

namespace Database\Seeders;

use App\Models\SubModule;
use Illuminate\Database\Seeder;

class SubModulesTableSeeder extends Seeder
{
    public function run()
    {
        $subModules = [
            [
                'module_id'     => 1,
                'name'          => 'Home',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 1,
                'name'          => 'About Us',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 1,
                'name'          => 'Contact Us',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 1,
                'name'          => 'Terms & Conditions',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 1,
                'name'          => 'Privacy Policy',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 1,
                'name'          => 'Cookies Policy',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 1,
                'name'          => 'Site map',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 2,
                'name'          => 'Authentication',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 3,
                'name'          => 'Roles',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 3,
                'name' 			=> 'Users',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 3,
                'name' 			=> 'Modules',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 3,
                'name' 			=> 'Submodules',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 3,
                'name' 			=> 'Permissions',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 2,
                'name'          => 'Profile',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
            [
                'module_id'     => 4,
                'name'          => 'Dashboard',
                'status'        => 1,
                'created_at'    => '2025-06-02 21:46:10',
                'updated_at'    => '2025-06-02 21:46:10',
            ],
        ];

        SubModule::insert($subModules);
    }
}
