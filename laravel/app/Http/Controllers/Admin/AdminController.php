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
  /**
   * variables
   */
  private $userService;
  private $courseService;
  private $adminService;
  private $assignmentService;

  /**
   * AdminController constructor
   * @param UserService $userService
   * @param CourseService $courseService
   * @param AdminService $adminService
   * @param AssignmentService $assignmentService
   */
  public function __construct(UserService $userService, 
    CourseService $courseService, 
    AdminService $adminService, 
    AssignmentService $assignmentService)
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
   * @return redirect()->back()
   */
  public function enrollTeacherCourse(TeacherCourseEnrollRequest $request)
  {
    $teacher_id = $request->teacher_id;
    $course_id = $request->course_id;
    $teacherCourse = $this->adminService->
              enrollTeacherCourse($teacher_id, $course_id);
    return redirect()->back();
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
   * @return redirect()->back()
   */
  public function submitAddAssignmentView(AssignmentFormRequest $request)
  {
    $validated = $request->validated();
    $this->assignmentService->addAssignment($validated);
    return redirect()->back();
  }
}
