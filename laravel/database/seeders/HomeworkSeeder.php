<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('homeworks')->insert([
            'assignment_id' => 3,
            'student_id' => 1,
            'file_path' => "homeworks/web/php/AungAung_PHP_1.doc",
            'uploaded_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('homeworks')->insert([
            'assignment_id' => 7,
            'student_id' => 2,
            'file_path' => "homeworks/web/html-css/BoBo_HTML_CSS_1.doc",
            'uploaded_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('homeworks')->insert([
            'assignment_id' => 8,
            'student_id' => 2,
            'file_path' => "homeworks/web/html-css/BoBo_HTML_CSS_2.doc",
            'uploaded_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 60,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('homeworks')->insert([
            'assignment_id' => 5,
            'student_id' => 2,
            'file_path' => "homeworks/web/html-css/BoBo_Javascript_1.doc",
            'uploaded_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
