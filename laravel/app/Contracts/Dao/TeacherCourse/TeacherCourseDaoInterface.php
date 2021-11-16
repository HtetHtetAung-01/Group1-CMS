<?php

namespace App\Contracts\Dao\TeacherCourse;

interface TeacherCourseDaoInterface {
    public function getEnrolledCoursesByTeacher($teacher_id);
}