<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    public function run()
    {
        $modules = [
            [
                'name'       => 'Website',
                'status'     => 1,
                'created_at' => '2025-06-02 21:46:10',
                'updated_at' => '2025-06-02 21:46:10',
            ],
            [
                'name'       => 'Authentication',
                'status'     => 1,
                'created_at' => '2025-06-02 21:46:10',
                'updated_at' => '2025-06-02 21:46:10',
            ],
            [
                'name'       => 'Access Control',
                'status'     => 1,
                'created_at' => '2025-06-02 21:46:10',
                'updated_at' => '2025-06-02 21:46:10',
            ],
            [
                'name'       => 'Dashboard',
                'status'     => 1,
                'created_at' => '2025-06-02 21:46:10',
                'updated_at' => '2025-06-02 21:46:10',
            ],
        ];

        Module::insert($modules);
    }
}
