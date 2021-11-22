<?php

namespace App\Services\Course;

use App\Contracts\Services\Course\CourseServiceInterface;
use App\Dao\Course\CourseDao;
use App\Dao\StudentCourse\StudentCourseDao;
use App\Dao\TeacherCourse\TeacherCourseDao;
use App\Services\Student\StudentService;

class CourseService implements CourseServiceInterface
{
  private $studentCourseDao;
  private $teacherCourseDao;
  private $courseDao;

  public function __construct(CourseDao $courseDao, StudentCourseDao $studentCourseDao, TeacherCourseDao $teacherCourseDao)
  {
    $this->courseDao = $courseDao;
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

  /**
   * get the required courses for $course_id
   * @return $requiredCourses
   */
  public function getRequiredCourseID($course_id)
  {
    return $this->courseDao->getRequiredCourseID($course_id);
  }

  /**
   * get the required courses list
   * @return $requiredCourses
   */
  public function getRequiredCourseList($requiredCourses)
  {
    return $this->courseDao->getRequiredCourseList($requiredCourses);
  }
}