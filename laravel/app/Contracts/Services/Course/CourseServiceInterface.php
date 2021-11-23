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

  /**
     * update the is_completed of the table student_courses
     */
    public function updateCourseComplete($student_id, $course_id, $status);

  /**
   * get the required course id for $course_id
   * @return $requiredCourses
   */
  public function getRequiredCourseID($course_id);

  /**
   * get the required courses list
   * @return $requiredCourses
   */
  public function getRequiredCourseList($requiredCourses);

  /**
   * get all the courses
   * @return $courseList
   */
  public function getAllCourseList();

  /**
   * add new course
   */
  public function addNewCourse($request);
}