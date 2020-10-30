<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersRoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles[] = ['name' => 'buyer', 'created_at' => now()];
        $userRoles[] = ['name' => 'seller', 'created_at' => now()];

        DB::table('users_role')->insert($userRoles);
    }
}
