<?php

namespace App\Contracts\Dao\TeacherCourse;

interface TeacherCourseDaoInterface {
    public function getEnrolledCoursesByTeacher($teacher_id);

  /**
   * get teacher course
   * @return $teacherCourseList
   */
  public function getTeacherCourse($id);
}