<?php 

namespace App\Services\Admin;

use App\Contracts\Services\Admin\AdminServiceInterface;
use App\Dao\TeacherCourse\TeacherCourseDao;

class AdminService implements AdminServiceInterface
{
  private $teacherCourseDao;

  public function __construct(TeacherCourseDao $teacherCourseDao)
  {
    $this->teacherCourseDao = $teacherCourseDao;
  }

    /**
   * Enroll teacher coursee
   * 
   */
  public function enrollTeacherCourse($teacher_id, $course_id)
  {
    return $this->teacherCourseDao->enrollTeacherCourse($teacher_id, $course_id);
  }
}