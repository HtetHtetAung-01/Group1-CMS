<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Services\Course\CourseService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
  private $courseService;
  private $userService;

  public function __construct(UserService $userService, CourseService $courseService)
  {
    $this->courseService = $courseService;
    $this->userService = $userService;
  }

  /**
   * show courses of each student
   * @return View students.course
   */
  public function showStudentCourse($student_id)
  {
    $scl = $this->courseService->getStudentCourse();
    foreach($scl as $key => $value) {
      $courseIdList[++$key] = $value->id;
    }

    foreach($courseIdList as $key => $value) {
      $number = DB::table('assignments')
              ->where('course_id', $courseIdList[$key])
              ->whereNull('deleted_at')
              ->count();
      $anl[$key] = $number;
      $key++;
    }  
    $S_AssignmentNoList = $anl;
    // info("Assignment no list");
    // info($S_AssignmentNoList);
    $cst = $this->getCourseStatus($student_id, $courseIdList);

    $index = 1;
    foreach($cst as $key => $value) {
      if($cst[$key] == "completed") {
        $courseStatusList[$index] = $cst[$key];
        $studentCourseList[$index] = $scl[$key-1];
        $index ++;
      }
    }
    foreach($cst as $key => $value) {
      if($cst[$key] == "progress") {
        $courseStatusList[$index] = $cst[$key];
        $studentCourseList[$index] = $scl[$key-1];
        $index ++;
      }
    }
    foreach($cst as $key => $value) {
      if($cst[$key] == "unlock next") {
        $courseStatusList[$index] = $cst[$key];
        $studentCourseList[$index] = $scl[$key-1];
        $index ++;
      }
    }
    foreach($cst as $key => $value) {
      if($cst[$key] == "lock") {
        $courseStatusList[$index] = $cst[$key];
        $studentCourseList[$index] = $scl[$key-1];
        $index ++;
      }
    }
    // To get the user details to display layout
    $user = $this->userService->getUserById($student_id);
    $roles = $this->userService->getUserRole($student_id);
    $role = $roles->type;
    $enrolledCourse = $this->userService->getEnrolledCourse($student_id, $role); 
    return view('course.studentCourse', compact('user', 'role', 'enrolledCourse', 'studentCourseList', 'S_AssignmentNoList', 'courseStatusList'));
  }

  /**
   * get status list of student courses
   * @return $courseStatusList
   */
  public function getCourseStatus($student_id, $totalCourse) 
  {
    $enrolledCourseList = DB::table('student_courses')
                          ->select('course_id', 'is_completed')
                          ->where('student_id', $student_id)
                          ->whereNull('deleted_at')
                          ->get();

    
    foreach($totalCourse as $key => $value) {
      $isenroll = false;
      foreach($enrolledCourseList as $enroll) {
        if($totalCourse[$key] == $enroll->course_id) {
          $isenroll = true;
          if($enroll->is_completed == '1') 
            $courseStatusList[$key] = "completed";
          else {
            if($this->isComplete($enroll->course_id, $student_id))
              $courseStatusList[$key] = "progress";
            else
              $courseStatusList[$key] = "unlock next";
          } 
            
        }
        $this->isComplete($enroll->course_id, $student_id);
      }
      if(!$isenroll)
        $courseStatusList[$key] = "lock";
    } 
    info("course status list");
    info($courseStatusList);
    
    return $courseStatusList;
  }

  /**
   * check required courses are completed or not
   */
  private $array = [];
  private $i = 0;
  public function isComplete($course_id, $student_id)
  {
    $this->i ++ ;
    $required_course = DB::table('courses')
                          ->select('required_courses')
                          ->where('id', $course_id)
                          ->whereNull('deleted_at')
                          ->get();

    foreach($required_course as $course) {
      if($course == null && $this->array == null) {
        return true;
      }
      $text = str_replace(array('[',']'), '', $course->required_courses);
      $this->array = explode(",", $text);
      foreach($this->array as $key => $value) {
        $is_completed = DB::table('student_courses')
              ->select('is_completed')
              ->where('student_id', $student_id)
              ->where('course_id', $this->array[$key])
              ->whereNull('deleted_at')
              ->get();
        
        foreach($is_completed as $status) {
          if($status->is_completed == 0) {
            return false;
          }
          else {
            return $this->isComplete($this->array[$key], $student_id);
          }
            
        }
      }
      return true;
    }
  }

  /**
   * show teacher courses
   * @return view teachers.course
   */
  public function showTeacherCourse($teacher_id)
  {
    $teacherCourseID = $this->courseService->getTeacherCourse($teacher_id);

    // get the course list of teacher $id
    $index = 0;
    $teacherCourseList = collect();
    foreach($teacherCourseID as $course) {
      $teacherCourse = DB::table('courses')
                        ->where('id', $course->course_id)
                        ->whereNull('deleted_at')
                        ->get();

      foreach($teacherCourse as $key => $value){
        $teacherCourseList->push($teacherCourse[$key]);
      }  

      // get the number of assignments in each course
      $number = DB::table('assignments')
                ->where('course_id', $course->course_id)
                ->whereNull('deleted_at')
                ->count();                       
      $T_assignmentNoList[$index] = $number; 
      $index++;
    }
    $user = $this->userService->getUserById($teacher_id);
    $roles = $this->userService->getUserRole($teacher_id);
    $role = $roles->type;
    $enrolledCourse = $this->userService->getEnrolledCourse($teacher_id, $role);
    
    return view('course.teacherCourse', compact('user', 'role', 'enrolledCourse', 'teacherCourseList', 'T_assignmentNoList'));
  }
}
