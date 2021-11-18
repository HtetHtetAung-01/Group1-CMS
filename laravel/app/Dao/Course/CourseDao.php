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
}