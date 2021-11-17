<?php

namespace App\Contracts\Dao\StudentCourse;

interface StudentCourseDaoInterface
{
    public function getEnrolledCourseTitlesByStudent($student_id);
    public function getTotalStudentByCourseTitle();
}