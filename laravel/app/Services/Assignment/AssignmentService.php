<?php

namespace App\Services\Assignment;

use App\Contracts\Dao\Assignment\AssignmentDaoInterface;
use App\Contracts\Services\Assignment\AssignmentServiceInterface;
use App\Dao\StudentAssignment\StudentAssignmentDao;
use App\Models\Assignment;
use Illuminate\Support\Facades\Storage;

/**
 * Service class for assignment
 */
class AssignmentService implements AssignmentServiceInterface
{
  /**
   * assignment dao
   */
  private $assignmentDao;
  private $studentAssignmentDao;

  /**
   * Class Constructor
   * @param AssignmentDaoInterface
   * @return 
   */
  public function __construct(AssignmentDaoInterface $assignmentDao, StudentAssignmentDao $studentAssignmentDao)
  {
      $this->assignmentDao = $assignmentDao;
      $this->studentAssignmentDao = $studentAssignmentDao;
  }

  /**
   * Add assignment from admin view
   * @param string $assignment
   * @return Object
   */
  public function addAssignment($validated)
  {
    $ROOT_DIR = 'assignments';

    if (!is_dir($ROOT_DIR)) {
      mkdir($ROOT_DIR);
    }

    $inputFile = $validated['file'];
    $validated['file_path'] = Storage::putFileAs(
      $ROOT_DIR, 
      $inputFile, 
      $inputFile->getClientOriginalName()
    );

    $this->assignmentDao->addAssignment($validated);
  }

  /**
  * To get all assignment list
   * @return Object 
    */
  public function getAllAssignment()
  {
    return $this->assignmentDao->getAllAssignment();
  }

  /**
   * To get assignment list by course id
   * @param string $id 
   * @return $courseDetails
   */
  public function getCourseDetails($id)
  {
    return $this->assignmentDao->getCourseDetails($id);
  }

  /**
   * To check enrolled or not
   * @param string $course_id
   * @param string $student_id
   * @return string $courseDetails
   */
  public function isEnrolled($student_id, $course_id)
  {
    return $this->assignmentDao->isEnrolled($student_id, $course_id);
  }

  /**
    * To enroll course by student id
    * @param string $course_id
    * @param string $student_id
    * @return $courseDetails
    */
  public function enrollCourse($student_id, $course_id)
  {
    return $this->assignmentDao->enrollCourse($student_id, $course_id);
  }

  /**
   * To start assignment
   * @param string $course_id
   * @param string $student_id
   * @param string $assignment_id
   * @return View courseDetails
   */
  public function addNullStudentAssignment($student_id, $course_id, $assignment_id)
  {
    return $this->assignmentDao->addNullStudentAssignment($student_id, $course_id, $assignment_id);
  }

  /**
   * To submit student's assignment
   * @param string $course_id
   * @param string $student_id
   * @param string $assignment_id
   * @param FileSubmitRequest $filename request form courseDetails
   * @return View courseDetails
   */
  public function addStudentAssignment($student_id, $course_id, $assignment_id, $filename)
  {
    $ROOT_DIR = 'new_assignments';
        
    if (!is_dir($ROOT_DIR)) {
        mkdir($ROOT_DIR);
    }
    
    $validated = $filename->validated();
    $file = $validated['inputFile'];
    $inputFileName = Storage::putFileAs($ROOT_DIR, $file, $file->getClientOriginalName());

    return $this->assignmentDao->
    addStudentAssignment($student_id, $course_id,
      $assignment_id, $inputFileName);
  }

  /**
   * To check all assignments for $course_id completed or not
   * @param string $course_id
   * @return $assignmentStatus
   */
  public function isCompleted($course_id)
  {
    return $this->assignmentDao->isCompleted($course_id);
  }

  /**
   * To check assignment is started or not
   * @param string $student_id
   * @param string $assignment_id
   * @return flag 
   */
  public function isStarted($student_id, $assignment_id)
  {
    return $this->assignmentDao->isStarted($student_id, $assignment_id);
  }

  /**
   * Get assignment for the course $course_id
   * @param string $course_id
   * @return $courseDetails
   */
  public function getAssignmentNamesbyCourseId($course_id)
  {
    return $this->assignmentDao->getAssignmentNamesbyCourseId($course_id);
  }

  /**
   * To download assignment by ID
   * @param $assignment_id
   * @return file assignment file
   */
  public function downloadAssignment($assignment_id)
  {
    $assignment = $this->assignmentDao->getAssignmentById($assignment_id);
    return Storage::download($assignment->file_path);
  }

  /**
     * Get the number of assignment by $course_id
     * @param string $course_id
     * @return $number
     */
    public function getNoOfAssignmentByCourse($course_id)
    {
        return $this->assignmentDao->
                    getNoOfAssignmentByCourse($course_id);
    }
    
    /**
     * Get all assignments records of $course_id by $student_id
     * @param string $student_id
     * @param string $assignment_id
     * @return $assignmentList
     */
    public function getAssignmentStatusByStudent($student_id, $assignment_id)
    {
        return $this->studentAssignmentDao->
                getAssignmentStatusByStudent(
                    $student_id, $assignment_id);
    }

    /**
     * Get all assignments by course
     * @param string $course_id
     * @return $assignmentList
     */
    public function getAllAssignmentByCourse($course_id)
    {
        return $this->assignmentDao->
                getAllAssignmentByCourse($course_id);
    }

    /**
     * To check all assignments for $course_id completed or not
     * @param $course_id
     * @return $assignmentStatus
     */
    public function isCompletedAssignment($student_id, $course_id)
    {
        $assignment_details = $this->assignmentDao->
                                isCompleted($course_id);
        $key = 0;
        $assignmentStatus = [];

        foreach ($assignment_details as $assignment) {
            $status = $this->studentAssignmentDao->
                        getAssignmentStatusByStudent(
                            $student_id, $assignment->id);

            $assignmentStatus[$key] = $status;
            $key++;
        }
        return $assignmentStatus;
    }

    /**
     * check all the assignments are completed or not
     * @param $student_id, $course_id
     * @return -> true or false
     */
    public function checkAllAssignmentCompleted($student_id, $course_id)
    {
        $assignmentStatus = $this->
                isCompletedAssignment($student_id, $course_id); 
        foreach($assignmentStatus as $status) {
        if($status != 'completed')
            return false;
        }
        
        return true;
    }

    /**
     * To show assignment is started or not
     * @param $course_id
     * @param $student_id
     * @return View courseDetails
     */
    public function showStarted($student_id, $course_id)
    {
        $start = [];
        $assignmentList = $this->assignmentDao->
                getAllAssignmentByCourse($course_id);

        foreach ($assignmentList as $key => $values) {
            $start[$key] = $this->assignmentDao->
                        isStarted($student_id, 
                        $assignmentList[$key]->id);
        }
        return $start; 
    }
}
