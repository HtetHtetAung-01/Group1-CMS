<?php

namespace App\Services\Course;

use App\Contracts\Services\Course\CourseServiceInterface;
use App\Dao\StudentCourse\StudentCourseDao;
use App\Dao\TeacherCourse\TeacherCourseDao;
use App\Services\Student\StudentService;

class CourseService implements CourseServiceInterface
{
  private $studentCourseDao;
  private $teacherCourseDao;

  public function __construct(StudentCourseDao $studentCourseDao, TeacherCourseDao $teacherCourseDao)
  {
    $this->studentCourseDao = $studentCourseDao;
    $this->teacherCourseDao = $teacherCourseDao;
  }
  /**
   * get student course list
   * @return $studentCourseList
   */
  public function getStudentCourse()
  {
    return $this->studentCourseDao->getStudentCourse();
  }

  /**
   * get teacher course
   * @return $teacherCourseList
   */
  public function getTeacherCourse($id)
  {
    return $this->teacherCourseDao->getTeacherCourse($id);
  }

  /**
     * update the is_completed of the table student_courses
     */
    public function updateCourseComplete($student_id, $course_id, $status)
    {
      return $this->studentCourseDao->updateCourseComplete($student_id, $course_id, $status);
    }
}