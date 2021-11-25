<?php

namespace App\Contracts\Dao\StudentCourse;

interface StudentCourseDaoInterface
{
    /**
     * To get enrolled course titles by student's id
     * @param string $student_id student's id
     * @return object
     */
    public function getEnrolledCourseTitlesByStudent($student_id);

    /**
     * To get total number of student by course title
     * @return object
     */
    public function getTotalStudentByCourseTitle();

    /**
     * To get number of total enrolled coureses by student's id
     * @param string $student_id student's id
     * @return object
     */
    public function getTotalEnrolledCoursebyStudent($student_id);

    /**
     * To get total number of completed courses by student's id
     * @param string $student_id student's id
     * @return object
     */
    public function getTotalCompletedCoursebyStudent($student_id);

    /**
     * To get student performance data
     * @param string $student_id student's id
     * @return object
     */
    public function getStudentPerformanceData($student_id);

    /**
     * get student course list
     * @return $studentCourseList
     */
    public function getStudentCourse();

    /**
     * update the is_completed of the table student_courses
     * @param string $student_id student's id
     * @param string $course_id course's id
     */
    public function updateCourseComplete($student_id, $course_id, $status);

    /**
     * get enrolled courses by student
     * @param $student_id student's id
     */
    public function getStudentEnrolledCourses($student_id);

    /**
     * get complete status of course by student
     * @param $student_id, $course_id
     * @return $status
     */
    public function getCourseCompleteStatusByStudent($student_id, $course_id);
}
