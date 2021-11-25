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
     * @param $id course_id
     */
    public function getCourseDetails($id);

    /**
     * To check enrolled or not
     * @param $course_id
     * @param $student_id
     */
    public function isEnrolled($course_id, $student_id);

    /**
     * To enroll course by student id
     * @param $course_id
     * @param $student_id
     */
    public function enrollCourse($course_id, $student_id);

    /**
     * To add student's assignment with null value
     * @param $course_id
     * @param $student_id
     * @param $assignment_id
     */
    public function addNullStudentAssignment($course_id, $student_id, $assignment_id);

    /**
     * To submit student's assignment
     * @param $filename request with inputs
     */
    public function addStudentAssignment($course_id, $student_id, $assignment_id, $filename);

    /**
     * To check assignment is completed or not
     * @param $course_id
     */
    public function isCompleted($course_id);

    /**
     * To check assignment is started or not
     * @param $student_id
     * @param $assignment_id
     */
    public function isStarted($student_id, $assignment_id);

    /**
     * To get assignment by course id
     * @param $course_id
     */
    public function getAssignmentNamesbyCourseId($course_id);

    /**
     * Get the number of assignment by $course_id
     * @param $course_id
     */
    public function getNoOfAssignmentByCourse($course_id);

    /**
     * get all assignments by course
     * @param $course_id
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