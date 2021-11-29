<?php

namespace App\Dao\Assignment;

use App\Contracts\Dao\Assignment\AssignmentDaoInterface;
use App\Models\Assignment;
use App\Models\StudentCourses;
use App\Models\StudentAssignments;
use Illuminate\Support\Facades\DB;

/**
 * Data accessing object for assignment
 */
class AssignmentDao implements AssignmentDaoInterface
{
  /**
   * Add assignment from admin view
   * @param string[] $validated
   */
  public function addAssignment($validated)
  {
    $assignment = new Assignment;
    $assignment->name = $validated['name'];
    $assignment->description = $validated['description'];
    $assignment->duration = $validated['duration'];
    $assignment->course_id = $validated['course_id'];
    $assignment->file_path = $validated['file_path'];
    $assignment->save();
  }

  /**
   * Get each course info data to show courseDetails
   * @param string $id course id
   * @return $courseDetails
   */
  public function getCourseDetails($id)
  {
    $courseDetails = DB::select(
      "SELECT courses.id as course_id, courses.title as course_title, 
      courses.description as course_description, assignments.*
      FROM assignments
      LEFT JOIN courses
      ON assignments.course_id = courses.id 
      WHERE courses.id= :id;", ['id' => $id]
    );
    return $courseDetails;
  }

  /**
     * To check enroll or not
     * @param string $student_id
     * @param string $course_id
     * @return $isEnrolled flag data
     */
  public function isEnrolled($student_id, $course_id)
  {
    $isEnrolled = DB::select(
      "SELECT * FROM student_courses 
      WHERE student_id= :student_id 
      AND course_id= :course_id;",
      ['student_id' => $student_id,
       'course_id' => $course_id]
    );
    return $isEnrolled == null;
  }

  /**
   * To enroll course by student id
   * @param string $student_id
   * @param string $course_id
   * @return Object $enrollCourse enroll course by student
   */
  public function enrollCourse($student_id, $course_id)
  {
    return DB::transaction(function () use ($student_id, $course_id) {
      $enrollCourse = new StudentCourses;
      $enrollCourse->student_id = $student_id;
      $enrollCourse->course_id = $course_id;
      $enrollCourse->enrolled_date = \Carbon\Carbon::now();
      $enrollCourse->save();
      return $enrollCourse;
    });
  }

  /**
   * To start assignment 
   * @param string $student_id
   * @param string $course_id
   * @param string $assignment_id
   * @return Object $studentAssignment register to start assignment
   */
  public function addNullStudentAssignment($student_id, $course_id, $assignment_id)
  {
    return DB::transaction(function () use ($student_id, $assignment_id) {
      $studentAssignment = new StudentAssignments;
      $studentAssignment->started_date = \Carbon\Carbon::now();
      $studentAssignment->student_id = $student_id;
      $studentAssignment->assignment_id = $assignment_id;
      $studentAssignment->save();
      return $studentAssignment;
    });
  }

  /**
   * To submit student's assignment
   * @param string $student_id
   * @param string $course_id
   * @param string $assignment_id
   * @param $filename request form courseDetails
   * @return $assignment_id
   */
  public function addStudentAssignment($student_id, $course_id, $assignment_id, $filename)
  {
    $array = DB::select("
      SELECT student_assignments.id 
      FROM student_assignments WHERE student_id= :student_id 
      AND assignment_id= :assignment_id;",
      [ 'student_id'=> $student_id,
        'assignment_id'=> $assignment_id
      ]
    );

    $id =  $array[0]->id;

    return DB::transaction(function () use ($id, $filename) {
      $studentAssignment = StudentAssignments::FindorFail($id);
      $studentAssignment->uploaded_date = \Carbon\Carbon::now();
      $studentAssignment->file_path = $filename;
      $studentAssignment->save();
    });

    return $assignment_id;
  }

  /**
   * To check assignment is completed or not
   * @param string $course_id
   * @return $assignment_details 
   */
  public function isCompleted($course_id)
  {
    $assignment_details = DB::table('assignments')
      ->select('*')
      ->where('course_id', $course_id)
      ->whereNull('deleted_at')
      ->get();

    return $assignment_details;
  }

  /**
   * To check assignment is started or not
   * @param string $student_id
   * @param string $assignment_id
   */
  public function isStarted($student_id, $assignment_id)
  {
    $start = DB::table('student_assignments')
      ->select("*")
      ->where('student_id', $student_id)
      ->where('assignment_id', $assignment_id)
      ->whereNull('deleted_at')
      ->get();
    if (count($start) == 0) {
      return false;
    } else {
      return true;
    }
  }

  /**
   * To get all assignments
   * @return Object 
   */
  public function getAllAssignment()
  {
    return DB::table('assignments')
              ->select('*')
              ->whereNull('deleted_at')
              ->get();
  }

  /**
   * To get all assignments by course id
   * @param string $course_id
   */
  public function getAssignmentNamesbyCourseId($course_id)
  {
    return DB::select(
      "SELECT A.id, A.name FROM assignments AS A
      LEFT OUTER JOIN courses AS C ON C.id = A.course_id 
      WHERE C.id = :course_id;",
      ['course_id' => $course_id]
    );
  }

  /**
   * get all assignment for the course
   * @param string $course_id
   * @return $assignmentList
   */
  public function getAssignmentsForCourse($course_id)
  {
    $assignmentList =  DB::table('assignments')
                        ->select('id', 'name')
                        ->where('course_id', $course_id)
                        ->whereNull('deleted_at')
                        ->get();

    return $assignmentList;                    
  }

  /**
     * Get the number of assignment by $course_id
     * @param string $course_id
     * @return $number 
     */
    public function getNoOfAssignmentByCourse($course_id)
    {
        $number = DB::table('assignments')
            ->where('course_id', $course_id)
            ->whereNull('deleted_at')
            ->count();

        return $number;
    }

    /**
     * Get all assignments by course
     * @param string $course_id
     * @return $assignmentList
     */
    public function getAllAssignmentByCourse($course_id)
    {
        $assignmentList = DB::table('assignments')
            ->select('*')
            ->where('course_id', $course_id)
            ->whereNull('deleted_at')
            ->get();

        return $assignmentList;
    }

    /**
     * Get assignment id to add new assignment
     * @param string $id Assignment id
     * @return Object
     */
    public function getAssignmentById($id)
    {
        return Assignment::find($id);
    }
}
