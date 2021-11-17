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

    /**
     * Get total number of student by courses title
     * @return stdClass total number of student by courses title
     */
    public function getTotalStudentByCourseTitle() {
        return DB::table("student_courses AS SC")
            ->select(DB::raw('C.title, count(SC.student_id) AS total'))
            ->leftJoin('courses AS C', "C.id", '=', 'SC.course_id')
            ->groupBy('SC.course_id')
            ->get();
    }
}