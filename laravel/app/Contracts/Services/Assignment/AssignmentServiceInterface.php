<?php

namespace App\Contracts\Services\Assignment;

use Illuminate\Http\Request;

/**
 * Interface for assignment service
 */
interface AssignmentServiceInterface
{

  public function addAssignment($validated);

  /**
   * To get all assignment list
   */
  public function getAllAssignment();

  /**
   * To get assignment list by course id
   */
  public function getCourseDetails($id);

  /**
   * To check enrolled or not
   */
  public function isEnrolled($course_id, $student_id);

  /**
   * To enroll course by student id
   */
  public function enrollCourse($course_id, $student_id);

  /**
   * To add student's assignment with null value
   */
  public function addNullStudentAssignment($course_id, $student_id, $assignment_id);

  /**
   * To submit student's assignment
   */
  public function addStudentAssignment($course_id, $student_id, $assignment_id, $filename);

  /**
   * To check assignment is completed or not
   */
  public function isCompleted($course_id);

  /**
   * To check assignment is started or not
   */
  public function isStarted($student_id, $assignment_id);

  /**
   * get assignment for the course $course_id
   */
  public function getAssignmentNamesbyCourseId($course_id);
  
  public function downloadAssignment($assignment_id);

  /**
   * Get the number of assignment by $course_id
   * @return $number
   */
  public function getNoOfAssignmentByCourse($course_id);

  /**
   * get all assignments records of $course_id by $student_id
   * @return $assignmentList
   */
  public function getAssignmentStatusByStudent($student_id, $assignment_id);

  /**
   * get all assignments by course
   * @return $assignemtnList
   */
  public function getAllAssignmentByCourse($course_id);
}
