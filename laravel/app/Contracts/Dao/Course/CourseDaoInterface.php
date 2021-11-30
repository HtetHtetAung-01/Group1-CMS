<?php

namespace App\Contracts\Dao\Course;


interface CourseDaoInterface
{
  /**
   * get the enrolled courses of user
   * @param $id, $role
   * @return $enrolledCourse
   */
  public function getEnrolledCourse($id, $role);

  /**
   * get the required courses for $course_id
   * @param $course_id
   * @return $requiredCourses
   */
  public function getRequiredCourseID($course_id);

  /**
   * get the required courses list
   * @param $requiredCourses
   * @return $requiredCourseList
   */
  public function getRequiredCourseList($requiredCourses);

  /**
   * get all the courses
   * @return $courseList
   */
  public function getAllCourseList();

  /**
   * add new course
   * @param $request
   */
  public function addNewCourse($request);

  /**
   * search course
   * @return $courseList
   */
  public function getSearchCourseList();

}
