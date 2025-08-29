<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'              => 'Admin',
                'email'             => 'admin@test.com',
                'email_verified_at' => '2025-06-02 21:46:10',
                'password'          => bcrypt('password'),
                'role_id'           => 2,
                'i_agree'           => 1,
                'avatar'            => null,
                'bio'               => 'This is admin.',
                'status'            => 1,
                'remember_token'    => null,
                'created_at'        => '2025-06-02 21:46:10',
                'updated_at'        => '2025-06-02 21:46:10',
            ],
        ];

        User::insert($users);
    }
}