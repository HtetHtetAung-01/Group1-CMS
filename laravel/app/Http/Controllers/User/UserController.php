<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;

class UserController extends Controller
{
  private $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  /**
   * show student information
   * @return view teachers.student-info 
   */
  public function showStudentsInfo($teacher_id) 
  {    
    $teacherCourse = $this->userService->getEnrolledCourse($teacher_id, 'Teacher');
    $studentList = $this->userService->getStudentList($teacherCourse);
    
    return view('student-info.student-info', compact('teacherCourse' ,'studentList'));
  }
}
