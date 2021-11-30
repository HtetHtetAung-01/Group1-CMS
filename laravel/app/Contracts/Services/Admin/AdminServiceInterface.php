<?php

namespace App\Contracts\Services\Admin;

interface AdminServiceInterface
{
  /**
   * Enroll teacher coursee
   * @param $teacher_id
   * @param $course_id
   */
  public function enrollTeacherCourse($teacher_id, $course_id);
}
