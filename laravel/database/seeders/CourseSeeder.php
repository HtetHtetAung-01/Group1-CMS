<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'title' => 'Laravel',
            'category' => 'Web Development',
            'description' => 'Laravel Course for Web Developers',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('courses')->insert([
            'title' => 'PHP',
            'category' => 'Web Development',
            'next_course_id' => 1,
            'description' => 'PHP Course for Backend Programmers',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('courses')->insert([
            'title' => 'JavaScript',
            'category' => 'Web Development',
            'next_course_id' => 1,
            'description' => 'JavaScript Course for Web Programming',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('courses')->insert([
            'title' => 'HTML & CSS',
            'category' => 'Web Development',
            'next_course_id' => 3,
            'description' => 'HTML/CSS Course for Web Design',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
