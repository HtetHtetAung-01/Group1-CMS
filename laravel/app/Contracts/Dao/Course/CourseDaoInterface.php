<?php

namespace App\Contracts\Dao\Course;


interface CourseDaoInterface
{
  /**
   * get the enrolled courses of user
   * @return $enrolledCourse
   */
  public function getEnrolledCourse($id, $role);

  /**
   * get the required courses for $course_id
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