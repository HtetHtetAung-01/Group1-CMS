<?php

namespace Database\Seeders;

use Database\Seeders\AssignmentSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\StudentAssignmentSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UserRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(AssignmentSeeder::class);
        Model::reguard();
    }
}
