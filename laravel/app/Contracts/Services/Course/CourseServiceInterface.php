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
}