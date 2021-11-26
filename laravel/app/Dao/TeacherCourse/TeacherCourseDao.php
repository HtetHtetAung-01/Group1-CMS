<?php

namespace App\Dao\TeacherCourse;

use App\Contracts\Dao\TeacherCourse\TeacherCourseDaoInterface;
use App\Models\TeacherCourse;
use Illuminate\Support\Facades\DB;

class TeacherCourseDao implements TeacherCourseDaoInterface
{
  public function getEnrolledCoursesByTeacher($teacher_id)
  {
    return DB::select(
      "SELECT C.id, C.title FROM teacher_courses AS TC
      LEFT OUTER JOIN courses AS C ON C.id = TC.course_id
      WHERE TC.teacher_id = $teacher_id;"
    );
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

  public function findTeacherCourse($teacher_id, $course_id)
  {
    $list = DB::table('teacher_courses')
                ->select('*')
                ->where('teacher_id', $teacher_id)
                ->where('course_id', $course_id)
                ->whereNull('deleted_at')
                ->get();

    if(count($list) > 0)
      return true;
    else 
      return false;            
  }

  /**
   * Enroll teacher course
   * 
   */
  public function enrollTeacherCourse($teacher_id, $course_id)
  {
    if($this->findTeacherCourse($teacher_id, $course_id))
      return null;
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