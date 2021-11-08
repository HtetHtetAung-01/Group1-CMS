<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role')->insert(['type' => 'Student']);
        DB::table('user_role')->insert(['type' => 'Teacher']);
        DB::table('user_role')->insert(['type' => 'Admin']);
    }
}
