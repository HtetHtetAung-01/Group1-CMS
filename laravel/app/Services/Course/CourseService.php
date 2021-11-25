<?php

namespace App\Services\Course;

use App\Contracts\Services\Course\CourseServiceInterface;
use App\Dao\Course\CourseDao;
use App\Dao\StudentCourse\StudentCourseDao;
use App\Dao\TeacherCourse\TeacherCourseDao;
use App\Services\Student\StudentService;

class CourseService implements CourseServiceInterface
{
  /**
   * variables
   */
  private $studentCourseDao;
  private $teacherCourseDao;
  private $courseDao;

  /**
   * CourseService constructor
   * @param $courseDao, $studentCourseDao, $teacherCourseDao
   */
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
   * @param $id
   * @return $teacherCourseList
   */
  public function getTeacherCourse($id)
  {
    return $this->teacherCourseDao->getTeacherCourse($id);
  }

  /**
     * update the is_completed of the table student_courses
     * @param $id, $course_id, $status
     */
    public function updateCourseComplete($student_id, $course_id, $status)
    {
      return $this->studentCourseDao->updateCourseComplete($student_id, $course_id, $status);
    }

  /**
   * get the required courses for $course_id
   * @param $course_id
   * @return $requiredCourses
   */
  public function getRequiredCourseID($course_id)
  {
    return $this->courseDao->getRequiredCourseID($course_id);
  }

  /**
   * get the required courses list
   * @param $requiredCourses
   * @return $requiredCourses
   */
  public function getRequiredCourseList($requiredCourses)
  {
    return $this->courseDao->getRequiredCourseList($requiredCourses);
  }

  /**
   * get all the courses
   * @return $courseList
   */
  public function getAllCourseList()
  {
    return $this->courseDao->getAllCourseList();
  }

  /**
   * add new course
   * @param $request
   */
  public function addNewCourse($request)
  {
    return $this->courseDao->addNewCourse($request);
  }

  /**
   * get enrolled courses by student
   * @param $student_id
   * @return $enrolledCourses
   */
  public function getStudentEnrolledCourses($student_id)
  {
    return $this->studentCourseDao->getStudentEnrolledCourses($student_id);
  }

  /**
   * get complete status of course by student
   * @param $student_id, $course_id
   * @return $status
   */
  public function getCourseCompleteStatusByStudent($student_id, $course_id)
  {
    return $this->studentCourseDao->getCourseCompleteStatusByStudent($student_id, $course_id);
  }
  
}