<?php

namespace App\Dao\StudentCourse;

use App\Contracts\Dao\StudentCourse\StudentCourseDaoInterface;
use Illuminate\Support\Facades\DB;

class StudentCourseDao implements StudentCourseDaoInterface
{
    public function getEnrolledCourseTitlesByStudent($student_id)
    {
        $courseTitles = DB::select(
            DB::raw("SELECT C.id, C.title FROM courses AS C
            LEFT OUTER JOIN student_courses AS SC ON SC.course_id = C.id
            WHERE SC.student_id = $student_id;"
        ));

        return $courseTitles;
    }
}