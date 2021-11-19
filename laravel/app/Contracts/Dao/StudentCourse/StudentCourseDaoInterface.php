<?php

namespace App\Contracts\Dao\StudentCourse;

interface StudentCourseDaoInterface
{
    public function getEnrolledCourseTitlesByStudent($student_id);

    /**
   * get student course list
   * @return $studentCourseList
   */
  public function getStudentCourse();
}