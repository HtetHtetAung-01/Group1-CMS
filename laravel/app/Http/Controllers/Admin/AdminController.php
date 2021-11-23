<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use App\Services\Course\CourseService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  private $userService;
  private $courseService;
  private $adminService;

  public function __construct(UserService $userService, CourseService $courseService, AdminService $adminService)
  {
    $this->userService = $userService;
    $this->courseService = $courseService;
    $this->adminService = $adminService;
  }

  public function showUserList()
  {
    $userList = $this->userService->getAllUser();
    $studentList = $this->userService->getAllStudent();
    $teacherList = $this->userService->getAllTeacher();
    $courseList = $this->courseService->getAllCourseList();
    return view('layouts.admin', compact('userList', 'studentList', 'teacherList', 'courseList'));
  }

  public function enrollTeacherCourse($teacher_id, $course_id)
  {

    // $course = $request->get('course');
    info("student = $teacher_id");
    info("course = $course_id");
    // info("course = $course");
    $teacherCourse = $this->adminService->enrollTeacherCourse($teacher_id, $course_id);

    return back();
  }
}
