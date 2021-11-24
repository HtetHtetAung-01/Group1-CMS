<?php

namespace App\Contracts\Dao\TeacherCourse;

interface TeacherCourseDaoInterface {
    public function getEnrolledCoursesByTeacher($teacher_id);

  /**
   * get teacher course
   * @return $teacherCourseList
   */
  public function getTeacherCourse($id);

  /**
   * Enroll teacher coursee
   * 
   */
  public function enrollTeacherCourse($teacher_id, $course_id);
}