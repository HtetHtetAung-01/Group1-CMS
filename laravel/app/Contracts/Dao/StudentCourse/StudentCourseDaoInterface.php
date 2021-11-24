<?php

namespace App\Contracts\Dao\StudentCourse;

interface StudentCourseDaoInterface
{
    public function getEnrolledCourseTitlesByStudent($student_id);
    public function getTotalStudentByCourseTitle();
    public function getTotalEnrolledCoursebyStudent($student_id);
    public function getTotalCompletedCoursebyStudent($student_id);
    public function getStudentPerformanceData($student_id);

    /**
     * get student course list
     * @return $studentCourseList
     */
    public function getStudentCourse();

    /**
     * update the is_completed of the table student_courses
     */
    public function updateCourseComplete($student_id, $course_id, $status);

    /**
     * get enrolled courses by student
     * @param $student_id
     * @return $enrolledCourses
     */
    public function getStudentEnrolledCourses($student_id);

    /**
     * get complete status of course by student
     * @param $student_id, $course_id
     * @return $status
     */
    public function getCourseCompleteStatusByStudent($student_id, $course_id);
}
