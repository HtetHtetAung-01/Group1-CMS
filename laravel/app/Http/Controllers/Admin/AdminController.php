<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherCourseEnrollRequest;
use App\Http\Requests\AssignmentFormRequest;
use App\Services\Admin\AdminService;
use App\Services\Assignment\AssignmentService;
use App\Services\Course\CourseService;
use App\Services\User\UserService;

class AdminController extends Controller
{
  private $userService;
  private $courseService;
  private $adminService;
  private $assignmentService;

  public function __construct(UserService $userService, CourseService $courseService, 
    AdminService $adminService, AssignmentService $assignmentService)
  {
    $this->userService = $userService;
    $this->courseService = $courseService;
    $this->adminService = $adminService;
    $this->assignmentService = $assignmentService;
  }

  public function showUserList()
  {
    $userList = $this->userService->getAllUser();
    $studentList = $this->userService->getAllStudent();
    $teacherList = $this->userService->getAllTeacher();
    $courseList = $this->courseService->getAllCourseList();
    $assignmentList = $this->assignmentService->getAllAssignment();
    return view('admin.adminView', compact('userList', 'studentList', 'teacherList', 'courseList', 'assignmentList'));
  }

  public function enrollTeacherCourse(TeacherCourseEnrollRequest $request)
  {
    $teacher_id = $request->teacher_id;
    $course_id = $request->course_id;
    $this->adminService->enrollTeacherCourse($teacher_id, $course_id);
    return redirect()->back();
  }

  public function enrollTeacher($teacher_id)
  {
    $teacher_name = $this->userService->getUserById($teacher_id)->name;
    $courseList = $this->courseService->getAllCourseList();
    return view('admin.teacherCourseEnroll', compact('teacher_id','teacher_name', 'courseList'));
  }

  public function showAddAssignmentView($assignment_id)
  {
    return view('assignments.add', compact('assignment_id'));
  }

  public function submitAddAssignmentView(AssignmentFormRequest $request)
  {
    $validated = $request->validated();
    $this->assignmentService->addAssignment($validated);
    return redirect()->back();
  }
}
