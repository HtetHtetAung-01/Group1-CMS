<?php

namespace App\Dao\TeacherCourse;

use App\Contracts\Dao\TeacherCourse\TeacherCourseDaoInterface;
use App\Models\TeacherCourse;
use Illuminate\Support\Facades\DB;

class TeacherCourseDao implements TeacherCourseDaoInterface
{
  public function getEnrolledCoursesByTeacher($teacher_id)
  {
    return DB::select(DB::raw(
      "SELECT C.id, C.title FROM teacher_courses AS TC
      LEFT OUTER JOIN courses AS C ON C.id = TC.course_id
      WHERE TC.teacher_id = $teacher_id;"
    ));
  }

    /**
   * get  teacher course
   * @return $teacherCourseID
   */
  public function getTeacherCourse($id)
  {
    $teacherCourseID = DB::table('teacher_courses')
                        ->where('teacher_id', $id)
                        ->whereNull('deleted_at')
                        ->get();
    
    return $teacherCourseID;                    
  }

  /**
   * Enroll teacher coursee
   * 
   */
  public function enrollTeacherCourse($teacher_id, $course_id)
  {
    $teacherCourse = new TeacherCourse();
    $teacherCourse->teacher_id = $teacher_id;
    $teacherCourse->course_id = $course_id;
    $teacherCourse->created_at = \Carbon\Carbon::now();
    $teacherCourse->updated_at = \Carbon\Carbon::now();
    $teacherCourse->deleted_at = null;
    $teacherCourse->save();

    return $teacherCourse;
  }
}