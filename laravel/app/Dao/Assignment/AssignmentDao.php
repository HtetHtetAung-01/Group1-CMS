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

  public function getAssignmentById($id)
  {
    return Assignment::find($id);
  }

  /**
   * Interface for assignment service
   */
  public function getCourseDetails($id)
  {
    $courseDetails = DB::select(
      DB::raw("SELECT courses.id as course_id, courses.title as course_title, courses.description as course_description, assignments.*
      FROM assignments
      LEFT JOIN courses
      ON assignments.course_id = courses.id 
      WHERE courses.id=" . $id . ";")
    );
    return $courseDetails;
  }

  /**
   * To check enroll or not
   */
  public function isEnrolled($student_id, $course_id)
  {
    $isEnrolled = DB::select("SELECT * FROM student_courses WHERE student_id=" . $student_id
      . " AND course_id= " . $course_id . " ;");
    return $isEnrolled == null;
  }

  /**
   * To enroll course by student id
   */
  public function enrollCourse($student_id, $course_id)
  {
    $enrollCourse = new StudentCourses;
    $enrollCourse->student_id = $student_id;
    $enrollCourse->course_id = $course_id;
    $enrollCourse->enrolled_date = \Carbon\Carbon::now();
    $enrollCourse->save();
    return $enrollCourse;
  }

  /**
   * To start assignment
   */
  public function addNullStudentAssignment($student_id, $course_id, $assignment_id)
  {
    $studentAssignment = new StudentAssignments;
    $studentAssignment->started_date = \Carbon\Carbon::now();
    $studentAssignment->uploaded_date = null;
    $studentAssignment->file_path = null;
    $studentAssignment->grade = null;
    $studentAssignment->student_id = $student_id;
    $studentAssignment->assignment_id = $assignment_id;
    $studentAssignment->save();
    return $studentAssignment;
  }

  /**
   * To submit student's assignment
   */
  public function addStudentAssignment($student_id, $course_id, $assignment_id, $filename)
  {
    $array = DB::select("SELECT student_assignments.id FROM student_assignments WHERE student_id=" . $student_id
      . " AND assignment_id= " . $assignment_id . " ;");

    $id =  $array[0]->id;

    $studentAssignment = StudentAssignments::FindorFail($id);
    $studentAssignment->uploaded_date = \Carbon\Carbon::now();
    $studentAssignment->file_path = $filename;
    $studentAssignment->grade = null;
    $studentAssignment->save();

    return $assignment_id;
  }

  /**
   * To check assignment is completed or not
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

  public function getAllAssignment()
  {
    return DB::table('assignments')
              ->select('*')
              ->whereNull('deleted_at')
              ->get();
  }

  public function getAssignmentNamesbyCourseId($course_id)
  {
    return DB::select(DB::raw(
      "SELECT A.id, A.name FROM assignments AS A
            LEFT OUTER JOIN courses AS C ON C.id = A.course_id 
            WHERE C.id = $course_id;"
    ));
  }

  /**
   * get all assignment for the course $course_id
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
}
