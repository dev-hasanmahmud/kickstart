<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'Guest',
                'status'            => 1,
                'created_at'        => '2025-06-02 21:46:10',
                'updated_at'        => '2025-06-02 21:46:10',
            ],
            [
                'name' => 'Admin',
                'status'            => 1,
                'created_at'        => '2025-06-02 21:46:10',
                'updated_at'        => '2025-06-02 21:46:10',
            ],
            [
                'name' => 'author',
                'status'            => 1,
                'created_at'        => '2025-06-02 21:46:10',
                'updated_at'        => '2025-06-02 21:46:10',
            ],
            [
                'name' => 'editor',
                'status'            => 1,
                'created_at'        => '2025-06-02 21:46:10',
                'updated_at'        => '2025-06-02 21:46:10',
            ],
        ];

        Role::insert($roles);
    }
}
