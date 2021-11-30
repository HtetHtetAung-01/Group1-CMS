<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Services\Course\CourseService;
use App\Services\User\UserService;
use App\Models\Course;
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
    public function __construct(
        UserService $userService,
        CourseService $courseService
    ) {
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
      
      $courseListWithAssignmentNo = $this->courseService->
                      getCourseListWithAssignmentNo($courseList);
      $courseStatusList = $this->courseService->
                getCourseStatus($student_id, $courseIdList);
      
      // sorting the course list and status list in order of compete status
      $studentCourseList = $this->courseService->
              sortCourses($courseStatusList, $courseListWithAssignmentNo, 1);  
      $courseStatusList = $this->courseService->
              sortCourses($courseStatusList, $courseStatusList, 0);
      
  
      
      return view('course.student', [
        'studentCourseList' => $studentCourseList,  
        'courseStatusList' => $courseStatusList
      ]);
    }


    /**
     * add new course view
     * @return View course-create
     */
    public function addNewCourseView()
    {
        return view('course.create');
    }

    /**
     * add new course
     * @param $requests
     * @return redirect()->back();
     */
    public function addNewCourse(AddNewCourseRequest $request)
    {
        $this->courseService->addNewCourse($request);
        return redirect()->route('admin-home', ['id' => Auth::user()->id]);
    }

    /**
     * search course
     * @return $courseList
     */
    public function searchCourse($student_id)
    {
      $courseList = $this->courseService->getSearchCourseList();
      $courseIdList = $this->courseService->getSearchCourseIdList($courseList);

      $courseListWithAssignmentNo = $this->courseService->
                    getCourseListWithAssignmentNo($courseList);;
      $courseStatusList = $this->courseService->
                getCourseStatus($student_id, $courseIdList);
      
      // sorting the course list and status list in order of compete status
      $studentCourseList = $this->courseService->
              sortCourses($courseStatusList, $courseListWithAssignmentNo, 1);  
      $courseStatusList = $this->courseService->
              sortCourses($courseStatusList, $courseStatusList, 0);
      
      return view('course.student', [
        'studentCourseList' => $studentCourseList, 
        'courseStatusList' => $courseStatusList,
      ]);
    }

}
