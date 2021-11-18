<?php

namespace App\Dao\TeacherCourse;

use App\Contracts\Dao\TeacherCourse\TeacherCourseDaoInterface;
use Illuminate\Support\Facades\DB;

class TeacherCourseDao implements TeacherCourseDaoInterface
{
    public function getEnrolledCoursesByTeacher($teacher_id)
    {
        return DB::select(DB::raw(
            "SELECT C.id, C.title FROM teacher_courses AS TC
            LEFT OUTER JOIN courses AS C ON C.id = TC.course_id
            WHERE TC.teacher_id = $teacher_id;"
        ));
    }
}