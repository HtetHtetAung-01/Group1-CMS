<?php

namespace App\Contracts\Dao\TeacherCourse;

interface TeacherCourseDaoInterface {
    
  /**
   * get enrolled courses by teacher
   * @param $teacher_id
   * @return object
   */
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