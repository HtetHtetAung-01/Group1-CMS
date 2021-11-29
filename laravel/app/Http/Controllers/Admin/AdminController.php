<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Services\Admin\AdminServiceInterface;
use App\Contracts\Services\Assignment\AssignmentServiceInterface;
use App\Contracts\Services\Course\CourseServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherCourseEnrollRequest;
use App\Http\Requests\AssignmentFormRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
  /**
   * variables
   */
  private $userService;
  private $courseService;
  private $adminService;
  private $assignmentService;

  public function __construct(
    UserServiceInterface $userService, 
    CourseServiceInterface $courseService, 
    AdminServiceInterface $adminService, 
    AssignmentServiceInterface $assignmentService)
  {
    $this->userService = $userService;
    $this->courseService = $courseService;
    $this->adminService = $adminService;
    $this->assignmentService = $assignmentService;
  }

  /**
   * show list of all users
   * @return view admin.admin
   */
  public function showUserList()
  {
    $userList = $this->userService->getAllUser();
    $studentList = $this->userService->getAllStudent();
    $teacherList = $this->userService->getAllTeacher();
    $courseList = $this->courseService->getAllCourseList();
    $assignmentList = $this->assignmentService->getAllAssignment();
    return view('admin.admin', [
      'userList' => $userList, 
      'studentList' => $studentList, 
      'teacherList' => $teacherList, 
      'courseList' => $courseList, 
      'assignmentList' => $assignmentList
    ]);
  }

  /**
   * enroll teacher course
   * @param TeacherCourseEnrollRequest $request
   * @return RedirectResponse
   */
  public function enrollTeacherCourse(TeacherCourseEnrollRequest $request, $teacher_id)
  {
    $this->adminService->enrollTeacherCourse($teacher_id, $request->course_id);
    return redirect()->route('admin-home', ['id'=>Auth::user()->id]);
  }

  /**
   * show enroll teacher page
   * @param $teacher_id
   * @return view admin.teacherCourseEnroll
   */
  public function enrollTeacher($teacher_id)
  {
    $teacher_name = $this->userService->
                  getUserById($teacher_id)->name;
    $courseList = $this->courseService->getAllCourseList();
    return view('admin.teacherCourseEnroll', [
      'teacher_id' => $teacher_id,
      'teacher_name' => $teacher_name, 
      'courseList' => $courseList
    ]);
  }

  /**
   * show add assignment view
   * @param $assignment_id
   * @return view assignments.add
   */
  public function showAddAssignmentView($assignment_id)
  {
    return view('assignments.add', [
      'assignment_id' => $assignment_id
    ]);
  }

  /**
   * submit add assignment view
   * @param AssignmentFormRequest $request
   * @return RedirectResponse
   */
  public function submitAddAssignmentView(AssignmentFormRequest $request)
  {
    $validated = $request->validated();
    $this->assignmentService->addAssignment($validated);
    return redirect()->route('admin-home', ['id'=>Auth::user()->id]);
  }
}
