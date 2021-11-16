<?php

namespace App\Contracts\Dao\Course;


interface CourseDaoInterface
{
  /**
   * get the enrolled courses of user
   * @return $enrolledCourse
   */
  public function getEnrolledCourse($id, $role);
}