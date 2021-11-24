<?php

namespace App\Contracts\Services\Admin;

interface AdminServiceInterface
{
  /**
   * Enroll teacher coursee
   * 
   */
  public function enrollTeacherCourse($teacher_id, $course_id);
}