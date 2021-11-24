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

  public function showLayout($id)
  {
    $user = $this->userService->getUserById($id);
    $roles = $this->userService->getUserRole($id);
    $role = $roles->type;
    $enrolledCourse = $this->userService->getEnrolledCourse($id, $role);  
    
    return view('layouts.app', compact('user', 'role', 'enrolledCourse'));
  }

  /**
   * show student information
   * @return view teachers.student-info 
   */
  public function showStudentsInfo($teacher_id) 
  {
    $user = $this->userService->getUserById($teacher_id);
    $roles = $this->userService->getUserRole($teacher_id);
    $role = $roles->type;
    $enrolledCourse = $this->userService->getEnrolledCourse($teacher_id, $role);
    
    $teacherCourse = $this->userService->getEnrolledCourse($teacher_id, 'Teacher');
    $studentList = $this->userService->getStudentList($teacherCourse);
    
    return view('teachers.student-info', compact('user', 'role', 'enrolledCourse', 'teacherCourse' ,'studentList'));
  }
}
