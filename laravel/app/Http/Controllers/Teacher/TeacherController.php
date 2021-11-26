<?php

namespace App\Http\Controllers\Teacher;

use App\Contracts\Services\Teacher\TeacherServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentFormRequest;
use App\Http\Requests\GradeSubmitRequest;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * variables
     */
    private $teacherService;
    private $userService;

    /**
     * TeacherController constructor
     * @param $teacherServiceInterface
     * @param $userService
     */
    public function __construct(
        TeacherServiceInterface $teacherServiceInterface, 
        UserServiceInterface $userService)
    {
        $this->teacherService = $teacherServiceInterface;
        $this->userService = $userService;
    }

    /**
     * StudentController constructor
     * @param $teacher_id
     * @return view teachers/assignment
     */
    public function showAssignments($teacher_id)
    {
        $courseTitles = $this->teacherService->
                    getAssignmentsByCourse($teacher_id);
        $user = $this->userService->getUserById($teacher_id);
        $roles = $this->userService->getUserRole($teacher_id);
        $role = $roles->type;
        $enrolledCourse = $this->userService->
                    getEnrolledCourse($teacher_id, $role);

        return view('teachers/assignment', compact('user', 'role', 'enrolledCourse', 'courseTitles'));
    }

    /**
     * StudentController constructor
     * @param $id
     * @return view teachers/dashboard
     */
    public function showDashboard($id)
    {
        $user = $this->userService->getUserById($id);
        $roles = $this->userService->getUserRole($id);
        $role = $roles->type;
        $enrolledCourse = $this->userService->
                    getEnrolledCourse($id, $role);

        $chartData = $this->teacherService->getChartData();
        $totalStudent = $this->teacherService->getTotalStudent();
    
        return view('teachers/dashboard', compact('user', 'role', 'enrolledCourse', 'chartData', 'totalStudent'));
    }

    /**
     * StudentController constructor
     * @param CommentFormRequest $quest
     * @param $id
     * @param $assignmentId
     * @return response()
     */
    public function addCommentToAssignment(CommentFormRequest $request, $id, $assignmentId) {
        $validated = $request->validated();
        $this->teacherService->addCommentToAssignment(
                        $validated, $id, $assignmentId);
        return response()->json(['success' => true]);
    }

    /**
     * StudentController constructor
     * @param $teacher_id
     * @param $student_assignment_id
     * @return teacherService
     */
    public function downloadAssignment($teacher_id, $student_assignment_id) {
        return $this->teacherService->
                downloadStudentAssignment($student_assignment_id);
    }
    
    /**
     * set grade
     * @param Request $request
     * @return response()->json()
     */
    public function setGrade(Request $request)
    {
       $id = $request->id;
       $student_assignment_id = $request->assignment_id;
       $grade = $request->grade;
       $this->teacherService->
                submitGrade($student_assignment_id, $grade);
                
       return response()->json(['success' => true]);
    }

}
