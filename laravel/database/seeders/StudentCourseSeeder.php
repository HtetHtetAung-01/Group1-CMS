<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_courses')->insert([
            'student_id' => 1,
            'course_id' => 2,
            'enrolled_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('student_courses')->insert([
            'student_id' => 2,
            'course_id' => 3,
            'enrolled_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('student_courses')->insert([
            'student_id' => 2,
            'course_id' => 4,
            'enrolled_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
