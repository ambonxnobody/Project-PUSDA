<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role_id' => 1,
                'user_id' => 1,
                'user_type' => 'App\Models\User',
            ],
            [
                'role_id' => 2,
                'user_id' => 2,
                'user_type' => 'App\Models\User',
            ],
            [
                'role_id' => 3,
                'user_id' => 3,
                'user_type' => 'App\Models\User',
            ],
            [
                'role_id' => 4,
                'user_id' => 5,
                'user_type' => 'App\Models\User',
            ],
            [
                'role_id' => 5,
                'user_id' => 5,
                'user_type' => 'App\Models\User',
            ],
            [
                'role_id' => 6,
                'user_id' => 6,
                'user_type' => 'App\Models\User',
            ],
            [
                'role_id' => 7,
                'user_id' => 7,
                'user_type' => 'App\Models\User',
            ],

        ];

       DB::table('role_user')->insert($roles);
    }
}
