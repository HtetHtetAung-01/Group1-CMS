<?php

namespace App\Contracts\Dao\Assignment;

use App\Models\Assignment;

/**
 * Interface for assignment service
 */
interface AssignmentDaoInterface
{
    /**
     * To get assignment list by course id
     * @param string $id course_id
     * @return $courseDetails
     */
    public function getCourseDetails($id);

    /**
     * To check enrolled or not
     * @param string $course_id
     * @param string $student_id
     * @return $courseDetails
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
     * @param string $course_id
     * @param string $student_id
     * @param string $assignment_id
     * @return $courseDetails
     */
    public function addNullStudentAssignment($course_id, $student_id, $assignment_id);

    /**
     * To submit student's assignment
     * @param string $student_id
     * @param string $course_id
     * @param string $assignment_id
     * @param $filename request with inputs
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
     * @param string $assignment_id
     * @return $courseDetails
     */
    public function isStarted($student_id, $assignment_id);

    /**
     * To get assignment by course id
     * @param string $course_id
     */
    public function getAssignmentNamesbyCourseId($course_id);

    /**
     * Get the number of assignment by $course_id
     * @param string $course_id
     */
    public function getNoOfAssignmentByCourse($course_id);

    /**
     * get all assignments by course
     * @param string $course_id
     * @return $assignemtnList
     */
    public function getAllAssignmentByCourse($course_id);

    /**
     * To add a new assignment
     */
    public function addAssignment(Assignment $assignment);

    /**
     * To get all assignment
     */
    public function getAllAssignment();

    /**
     * To get assignment by id
     * @param $id
     */
    public function getAssignmentById($id);
}