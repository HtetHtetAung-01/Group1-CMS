<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherCourseEnrollRequest;
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
    return view('admin.adminView', compact('userList', 'studentList', 'teacherList', 'courseList'));
  }

  public function enrollTeacherCourse(TeacherCourseEnrollRequest $request)
  {
    $teacher_id = $request->teacher_id;
    $course_id = $request->course_id;
    $teacherCourse = $this->adminService->enrollTeacherCourse($teacher_id, $course_id);
    if($teacherCourse == null)
    return redirect()->back()->with('teacherCourse');
  }

  public function enrollTeacher($teacher_id)
  {
    $teacher_name = $this->userService->getUserById($teacher_id)->name;
    $courseList = $this->courseService->getAllCourseList();
    return view('admin.teacherCourseEnroll', compact('teacher_id','teacher_name', 'courseList'));
  }
}
