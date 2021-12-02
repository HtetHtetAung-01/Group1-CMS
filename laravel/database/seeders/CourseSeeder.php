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
            'title' => 'HTML & CSS',
            'category' => 'Web Development',
            'description' => 'HTML/CSS Course for Web Design',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('courses')->insert([
            'title' => 'JavaScript',
            'category' => 'Web Development',
            'description' => 'JavaScript Course for Web Programming',
            'required_courses' => json_encode(1),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('courses')->insert([
            'title' => 'PHP',
            'category' => 'Web Development',
            'description' => 'PHP Course for Backend Programmers',
            'required_courses' => json_encode(2),
            'created_at' => Carbon::now(3)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('courses')->insert([
            'title' => 'Laravel',
            'category' => 'Web Development',
            'description' => 'Laravel Course for Web Developers',
            'required_courses' => json_encode(3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
