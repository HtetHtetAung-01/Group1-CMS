<?php

namespace App\Contracts\Services\Course;

interface CourseServiceInterface
{
  /**
   * get student course list
   * @return $studentCourseList
   */
  public function getStudentCourse();

  /**
   * get teacher course
   * @return $teacherCourseList
   */
  public function getTeacherCourse($id);
}