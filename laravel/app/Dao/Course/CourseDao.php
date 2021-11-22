<?php

namespace App\Dao\Course;

use App\Contracts\Dao\Course\CourseDaoInterface;
use Illuminate\Support\Facades\DB;

class CourseDao implements CourseDaoInterface
{
  /**
   * get the enrolled enroll$enrolledCourse of user
   * @return $enrolledCourse
   */
  public function getEnrolledCourse($id, $role)
  {
    if($role == 'Student') {
      $enrolledCourseID = DB::table('student_courses')
                  ->select('course_id')
                  ->where('student_id', $id)
                  ->whereNull('deleted_at')
                  ->get();
    }
    elseif($role == 'Teacher'){
      $enrolledCourseID = DB::table('teacher_courses')
                  ->select('course_id')
                  ->where('teacher_id', $id)
                  ->whereNull('deleted_at')
                  ->get();
    }

    $enrolledCourse = collect();
    foreach($enrolledCourseID as $courseID) {
      $course = DB::table('courses')
                  ->select('*')
                  ->where('id', $courseID->course_id)
                  ->whereNull('deleted_at')
                  ->first();

      $enrolledCourse->push($course);
    }
    return $enrolledCourse;
    
  }

  /**
   * get the required courses for $course_id
   * @return $requiredCourses
   */
  public function getRequiredCourseID($course_id)
  {
    $requiredCourseID = DB::table('courses')
              ->select('required_courses')
              ->where('id', $course_id)
              ->whereNull('deleted_at')
              ->get();

    return $requiredCourseID;          
  }

  /**
   * get the required courses list
   * @return $requiredCourses
   */
  public function getRequiredCourseList($requiredCourses)
  {
    $requiredCourseList = collect();
    foreach($requiredCourses as $required) {
      $course = DB::table('courses')
                  ->select('id','title')
                  ->where('id', $required)
                  ->whereNull('deleted_at')
                  ->get();

      if(count($course) > 0) {
        $requiredCourseList->push($course[0]);
      }                 
    }
    return $requiredCourseList;
  }
}