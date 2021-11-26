<?php

namespace App\Contracts\Dao\Assignment;

use App\Models\Assignment;

/**
 * Interface for assignment service
 */
interface AssignmentDaoInterface
{

  /**
   * To add a new assignment
   */
  public function addAssignment($validated);

  /**
   * To get all assignment
   */
  public function getAllAssignment();

  /**
   * To get assignment by id
   */
  public function getAssignmentById($id);

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
   * @param $filename request with inputs
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

  public function getAssignmentNamesbyCourseId($course_id);
}
