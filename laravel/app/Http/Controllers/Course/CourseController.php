<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Assignment\AssignmentController;
use App\Http\Controllers\Controller;
use App\Services\Assignment\AssignmentService;
use App\Services\Course\CourseService;
use App\Services\User\UserService;
use \App\Http\Requests\AddNewCourseRequest;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
  /**
   * variables
   */
  private $courseService;
  private $userService;
  private $assignmentService;

  /**
     * CourseController constructor
     * @param UserService $userService
     * @param CourseService $courseService
     * @param AssignmentService $assignmentService
     * @param $userService
     */
  public function __construct(UserService $userService, 
        CourseService $courseService, 
        AssignmentService $assignmentService)
  {
    $this->courseService = $courseService;
    $this->userService = $userService;
    $this->assignmentService = $assignmentService;
  }

  /**
   * show courses of each student
   * @param $student_id
   * @return View students.course
   */
  public function showStudentCourse($student_id)
  {
    $scl = $this->courseService->getAllCourseList();
    foreach($scl as $key => $value) {
      $courseIdList[++$key] = $value->id;
    }
    
    foreach($courseIdList as $key => $value) {
      
      $number = $this->assignmentService->getNoOfAssignmentByCourse($courseIdList[$key]);
      $anl[$key] = $number;
      $key++;
    }  
    $S_AssignmentNoList = $anl;
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
   * @param $student_id, $totalCourse
   * @return $courseStatusList
   */
  public function getCourseStatus($student_id, $totalCourse) 
  {
    $enrolledCourseList = $this->courseService->getStudentEnrolledCourses($student_id);
    
    foreach($totalCourse as $key => $value) {
      $isenroll = false;
      foreach($enrolledCourseList as $enroll) {
        if($totalCourse[$key] == $enroll->course_id) {
          $isenroll = true;
          $assignmentComplete = $this->checkAllAssignmentCompleted($student_id, $enroll->course_id);
          if($assignmentComplete == true) {
            $this->courseService->updateCourseComplete($student_id, $enroll->course_id, 1);
            $courseStatusList[$key] = "completed";
          }
          else {
            $this->courseService->updateCourseComplete($student_id, $enroll->course_id, 0);
            if($this->isCompletedRequiredCourses($enroll->course_id, $student_id))
              $courseStatusList[$key] = "progress";
            else
              $courseStatusList[$key] = "unlock next";
          }
           
        }
      }
      if(!$isenroll)
        $courseStatusList[$key] = "lock";
    } 
    return $courseStatusList;
  }

  /**
   * check required courses of $course_id by $student_id are completed or not
   * @param $course_id, student_id
   * @return -> true or false
   */
  private $array = [];
  private $i = 0;
  public function isCompletedRequiredCourses($course_id, $student_id)
  {
    $this->array = [];
    $this->i ++ ;
    $required_course = $this->courseService->getRequiredCourseID($course_id);
    foreach($required_course as $course) {
      if($course->required_courses == null && count($this->array) == 0) {
        return true;
      }
      $this->array = $this->changeStringToArray($course->required_courses);;
      foreach($this->array as $key => $value) {
        $status  = $this->courseService->getCourseCompleteStatusByStudent($student_id, $this->array[$key]);

        if($status == NULL) {
          return false;
        }
        else if($status == 0) {
          return false;
        }
        else {
          return $this->isCompletedRequiredCourses($this->array[$key], $student_id);
        }
      }
      return true;
    }
  }

  /**
   * Change string to array
   * @param $text
   * @return $array
   */
  public function changeStringToArray($text)
  {
    $remove_text = str_replace(array('[',']'), '', $text);
    $array = explode(",", $remove_text);
    return $array;
  }

  /**
   * check all the assignments are completed or not
   * @param $student_id, $course_id
   * @return -> true or false
   */
  public function checkAllAssignmentCompleted($student_id, $course_id)
  {
    $assignmentStatus = app('App\Http\Controllers\Assignment\AssignmentController')
    ->isCompletedAssignment($student_id, $course_id);
    foreach($assignmentStatus as $status) {
      if($status != 'completed')
        return false;
    }
    
    return true;
  }

  /**
   * add new course
   * @param $requests
   * @return redirect()->back();
   */
  public function addNewCourse(AddNewCourseRequest $request)
  {
    $validated = $request->validated();
    $this->courseService->addNewCourse($request);
    return redirect()->back();
  }
}
