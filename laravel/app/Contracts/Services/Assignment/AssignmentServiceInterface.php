<?php

namespace App\Contracts\Services\Assignment;

/**
 * Interface for assignment service
 */
interface AssignmentServiceInterface
{
    /**
     * To get assignment list by course id
     * @param string $id 
     * @return $courseDetails
     */
    public function getCourseDetails($id);

    /**
     * To check enrolled or not
     * @param string $course_id
     * @param string $student_id
     * @return string $courseDetails
     */
    public function isEnrolled($course_id, $student_id);

    /**
     * To enroll course by student id
     * @param string $course_id
     * @param string $student_id
     * @return $courseDetails
     */
    public function enrollCourse($course_id, $student_id);

    /**
     * To add student's assignment with null value
     * @param string $student_id
     * @param string $course_id
     * @param string $assignment_id
     * @return Object $studentAssignment register to start assignment
     */
    public function addNullStudentAssignment($course_id, $student_id, $assignment_id);

    /**
     * To submit student's assignment
     * @param string $course_id
     * @param string $student_id
     * @param string $assignment_id
     * @param string $filename Request form courseDetails
     * @return $courseDetails
     */
    public function addStudentAssignment($course_id, $student_id, $assignment_id, $filename);

    /**
     * To check assignment is completed or not
     * @param string $course_id
     * @return $courseDetails
     */
    public function isCompleted($course_id);

    /**
     * To check assignment is started or not
     * @param string $student_id
     * @param $assignment_id
     * @return $courseDetails
     */
    public function isStarted($student_id, $assignment_id);

    /**
     * Get assignment for the course $course_id
     * @param string $course_id
     * @return $courseDetails
     */
    public function getAssignmentNamesbyCourseId($course_id);

    /**
     * To download assignment
     * @param string $assignment_id
     * @return $courseDetails
     */
    public function downloadAssignment($assignment_id);

    /**
     * Get the number of assignment by $course_id
     * @param string $course_id
     * @return $number
     */
    public function getNoOfAssignmentByCourse($course_id);

    /**
     * Get all assignments records of $course_id by $student_id
     * @param string $student_id
     * @param string $assignment_id
     * @return $assignmentList
     */
    public function getAssignmentStatusByStudent($student_id, $assignment_id);

    /**
     * To get all assignment list
     * @return Object 
     */
    public function getAllAssignment();

    /**
     * get all assignments by course
     * @param string $course_id
     * @return $assignmentList
     */
    public function getAllAssignmentByCourse($course_id);

    /**
     * Add assignment from admin view
     * @param string $assignment
     * @return Object
     */
    public function addAssignment($validated);
}