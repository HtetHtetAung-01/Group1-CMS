<?php

namespace Database\Seeders;

use Database\Seeders\AssignmentSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\HomeworkSeeder;
use Database\Seeders\RoleSeeder;
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
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(AssignmentSeeder::class);
        $this->call(HomeworkSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(StudentCourseSeeder::class);
        $this->call(TeacherCourseSeeder::class);
        Model::reguard();
    }
}
