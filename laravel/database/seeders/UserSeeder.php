<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Aung Aung',
            'dob' => '1990-12-30',
            'gender' => 'M',
            'email' => 'agag@gmail.com',
            'phone' => '0912345',
            'address' => 'Yangon',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Bo Bo',
            'dob' => '2000-12-30',
            'gender' => 'M',
            'email' => 'bobo@gmail.com',
            'phone' => '099876',
            'address' => 'Mandalay',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Cinder',
            'dob' => '1980-12-30',
            'gender' => 'F',
            'email' => 'cinder@gmail.com',
            'phone' => '088888',
            'address' => 'Yangon',
            'password' => Hash::make('password'),
            'role_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Doe Lay',
            'dob' => '1985-12-30',
            'gender' => 'M',
            'email' => 'doelay@gmail.com',
            'phone' => '019999',
            'address' => 'Yangon',
            'password' => Hash::make('password'),
            'role_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
