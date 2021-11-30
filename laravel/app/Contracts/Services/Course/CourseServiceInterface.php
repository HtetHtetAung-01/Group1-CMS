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
     * @param $id
     * @return $teacherCourseList
     */
    public function getTeacherCourse($id);

    /**
     * update the is_completed of the table student_courses
     * @param $student_id, $course_id, $status
     */
    public function updateCourseComplete($student_id, $course_id, $status);

    /**
     * get the required course id for $course_id
     * @param $course_id
     * @return $requiredCourses
     */
    public function getRequiredCourseID($course_id);

    /**
     * get the required courses list
     * @param $requiredCourse
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

    /**
     * get status list of student courses
     * @param $student_id, $totalCourse
     * @return $courseStatusList
     */
    public function getCourseStatus($student_id, $totalCourse);

    /**
     * sort courses in order of completed status
     */
    public function sortCourses($statusArray, $sortingArray, $index);

    /**
     * get the list of number of assignments 
     */
    public function getCourseListWithAssignmentNo($courseIdList);

    /**
     * search course
     * @return $courseList
     */
    public function getSearchCourseList();

    /**
     * search course
     * @return $courseIdList
     */
    public function getSearchCourseIdList($courseList);

        /**
         * get the list of number of assignments 
         */
        public function getNoOfAssignmentsList();
}
