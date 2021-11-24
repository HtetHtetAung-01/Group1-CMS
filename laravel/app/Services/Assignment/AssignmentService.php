<?php

namespace App\Services\Assignment;

use App\Contracts\Dao\Assignment\AssignmentDaoInterface;
use App\Contracts\Services\Assignment\AssignmentServiceInterface;
use App\Models\Assignment;
use Illuminate\Support\Facades\Storage;

/**
 * Service class for assignment.
 */
class AssignmentService implements AssignmentServiceInterface
{
  /**
   * assignment dao
   */
  private $assignmentDao;
  /**
   * Class Constructor
   * @param AssignmentDaoInterface
   * @return
   */
  public function __construct(AssignmentDaoInterface $assignmentDao)
  {
    $this->assignmentDao = $assignmentDao;
  }

  public function addAssignment($validated)
  {

    $ROOT_DIR = 'assignments';

    if (!is_dir($ROOT_DIR)) {
      mkdir($ROOT_DIR);
    }

    $inputFile = $validated['file'];
    $file_path = Storage::putFileAs($ROOT_DIR, $inputFile, $inputFile->getClientOriginalName());

    $assignment = new Assignment;
    $assignment->name = $validated['name'];
    $assignment->description = $validated['description'];
    $assignment->duration = $validated['duration'];
    $assignment->course_id = $validated['course_id'];
    $assignment->file_path = $file_path;

    $this->assignmentDao->addAssignment($assignment);
  }

  public function getAllAssignment()
  {
    return $this->assignmentDao->getAllAssignment();
  }

  /**
   * To get assignment list by course id
   */
  public function getCourseDetails($id)
  {
    return $this->assignmentDao->getCourseDetails($id);
  }

  /**
   * To check enrolled or not
   */
  public function isEnrolled($student_id, $course_id)
  {
    return $this->assignmentDao->isEnrolled($student_id, $course_id);
  }

  /**
   * To enroll course by student id
   */
  public function enrollCourse($student_id, $course_id)
  {
    return $this->assignmentDao->enrollCourse($student_id, $course_id);
  }

  /**
   * To start assignment
   */
  public function addNullStudentAssignment($student_id, $course_id, $assignment_id)
  {
    return $this->assignmentDao->addNullStudentAssignment($student_id, $course_id, $assignment_id);
  }

  /**
   * To submit student's assignment
   */
  public function addStudentAssignment($student_id, $course_id, $assignment_id, $filename)
  {
    return $this->assignmentDao->addStudentAssignment($student_id, $course_id, $assignment_id, $filename);
  }

  /**
   * To check assignment is completed or not
   */
  public function isCompleted($course_id)
  {
    return $this->assignmentDao->isCompleted($course_id);
  }

  /**
   * To check assignment is started or not
   */
  public function isStarted($student_id, $assignment_id)
  {
    return $this->assignmentDao->isStarted($student_id, $assignment_id);
  }

  
  /**
   * get assignment for the course $course_id
   */
  public function getAssignmentNamesbyCourseId($course_id)
  {
    return $this->assignmentDao->getAssignmentNamesbyCourseId($course_id);
  }
  /**
   * To download assignment by ID
   */
  public function downloadAssignment($assignment_id)
  {
    $assignment = $this->assignmentDao->getAssignmentById($assignment_id);
    return Storage::download($assignment->file_path);
  }
}
