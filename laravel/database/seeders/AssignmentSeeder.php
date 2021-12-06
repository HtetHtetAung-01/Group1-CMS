<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignments')->insert([
            'name' => 'HTML/CSS Assignment 1: Basic',
            'description' => 'This is the first HTML/CSS assignment',
            'duration' => 3,
            'file_path' => 'assignments/web/html-css/assignment1.doc',
            'course_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('assignments')->insert([
            'name' => 'HTML/CSS Assignment 2: Intermediate',
            'description' => 'This is the second HTML/CSS assignment',
            'duration' => 4,
            'file_path' => 'assignments/web/html-css/assignment2.doc',
            'course_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('assignments')->insert([
            'name' => 'Javascript Assignment 1: Basic',
            'description' => 'This is the first Javascript assignment',
            'duration' => 3,
            'file_path' => 'assignments/web/javascript/assignment1.doc',
            'course_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        DB::table('assignments')->insert([
            'name' => 'Javascript Assignment 2: Intermediate',
            'description' => 'This is the second Javascript assignment',
            'duration' => 4,
            'file_path' => 'assignments/web/javascript/assignment2.doc',
            'course_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('assignments')->insert([
            'name' => 'PHP Assignment 1: Basic',
            'description' => 'This is the first PHP assignment',
            'duration' => 5,
            'file_path' => 'assignments/web/php/assignment1.doc',
            'course_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        DB::table('assignments')->insert([
            'name' => 'PHP Assignment 2: Intermediate',
            'description' => 'This is the second PHP assignment',
            'duration' => 8,
            'file_path' => 'assignments/web/php/assignment2.doc',
            'course_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('assignments')->insert([
            'name' => 'Laravel Assignment 1: Basic',
            'description' => 'This is the first Laravel assignment',
            'duration' => 3,
            'file_path' => 'assignments/web/laravel/assignment1.doc',
            'course_id' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        DB::table('assignments')->insert([
            'name' => 'Laravel Assignment 2: Intermediate',
            'description' => 'This is the second Laravel assignment',
            'duration' => 8,
            'file_path' => 'assignments/web/laravel/assignment2.doc',
            'course_id' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
