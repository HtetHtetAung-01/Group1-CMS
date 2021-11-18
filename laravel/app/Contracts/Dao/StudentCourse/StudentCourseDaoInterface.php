<?php

namespace App\Contracts\Dao\StudentCourse;

interface StudentCourseDaoInterface
{
    public function getEnrolledCourseTitlesByStudent($student_id);
    public function getTotalStudentByCourseTitle();
    public function getTotalEnrolledCoursebyStudent($student_id);
    public function getTotalCompletedCoursebyStudent($student_id);
    public function getStudentPerformanceData($student_id);
}