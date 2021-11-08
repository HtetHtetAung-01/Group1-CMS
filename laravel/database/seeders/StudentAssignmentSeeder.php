<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_assignments')->insert([
            'student_id' => 1,
            'assignment_id' => 4,
            'started_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('student_assignments')->insert([
            'student_id' => 1,
            'assignment_id' => 3,
            'file_path' => "student/assignments/web/php/AungAung_PHP_1.doc",
            'started_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'uploaded_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('student_assignments')->insert([
            'student_id' => 2,
            'assignment_id' => 7,
            'file_path' => "student/assignments/web/html-css/BoBo_HTML_CSS_1.doc",
            'started_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'uploaded_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('student_assignments')->insert([
            'student_id' => 2,
            'assignment_id' => 8,
            'file_path' => "student/assignments/web/html-css/BoBo_HTML_CSS_2.doc",
            'started_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'uploaded_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 60,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('student_assignments')->insert([
            'student_id' => 2,
            'assignment_id' => 5,
            'file_path' => "student/assignments/web/html-css/BoBo_Javascript_1.doc",
            'started_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'uploaded_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
