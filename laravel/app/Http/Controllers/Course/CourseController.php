<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Services\Course\CourseService;
use App\Services\User\UserService;
use App\Http\Requests\AddNewCourseRequest;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
  /**
   * variables
   */
  private $courseService;
  private $userService;

  /**
     * CourseController constructor
     * @param UserService $userService
     * @param CourseService $courseService
     * @param $userService
     */
  public function __construct(UserService $userService, 
        CourseService $courseService)
  {
    $this->courseService = $courseService;
    $this->userService = $userService;
  }

  /**
   * show courses of each student
   * @param $student_id
   * @return View students.course
   */
  public function showStudentCourse($student_id)
  {
    $courseIdList = $this->courseService->getAllCourseIdList();
    $courseList = $this->courseService->getAllCourseList();
    
    $S_AssignmentNoList = $this->courseService->
              getNoOfAssignmentsList($courseIdList);;
    $courseStatusList = $this->courseService->
              getCourseStatus($student_id, $courseIdList);
    
    // sorting the course list and status list in order of compete status
    $studentCourseList = $this->courseService->
            sortCourses($courseStatusList, $courseList, 1);  
    $courseStatusList = $this->courseService->
            sortCourses($courseStatusList, $courseStatusList, 0);
    
    // To get the user details to display layout
    $user = $this->userService->getUserById($student_id);
    $roles = $this->userService->getUserRole($student_id);
    $role = $roles->type;
    $enrolledCourse = $this->userService->
          getEnrolledCourse($student_id, $role); 

    return view('course.studentCourse', [
      'user' => $user, 
      'role' => $role, 
      'enrolledCourse' => $enrolledCourse, 
      'studentCourseList' => $studentCourseList, 
      'S_AssignmentNoList' => $S_AssignmentNoList, 
      'courseStatusList' => $courseStatusList
    ]);
  }

  /**
   * add new course view
   * @return View course-create
   */
  public function addNewCourseView()
  {
    return view('course.createCourse');
  }

  /**
   * add new course
   * @param $requests
   * @return redirect()->back();
   */
  public function addNewCourse(AddNewCourseRequest $request)
  {
    $this->courseService->addNewCourse($request);
    return redirect()->route('admin-home', ['id'=>Auth::user()->id]);
  }
}
