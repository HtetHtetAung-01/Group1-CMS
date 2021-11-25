<?php 

namespace App\Services\Admin;

use App\Contracts\Services\Admin\AdminServiceInterface;
use App\Dao\TeacherCourse\TeacherCourseDao;

class AdminService implements AdminServiceInterface
{
  /**
   * variable
   */
  private $teacherCourseDao;

  /**
   * AdminService constructor
   * @param TeacherCourseDao $teacherCourseDao
   */
  public function __construct(TeacherCourseDao $teacherCourseDao)
  {
    $this->teacherCourseDao = $teacherCourseDao;
  }

    /**
   * Enroll teacher coursee
   * @param $teacher_id
   * @param $course_id
   */
  public function enrollTeacherCourse($teacher_id, $course_id)
  {
    return $this->teacherCourseDao->enrollTeacherCourse($teacher_id, $course_id);
  }
}