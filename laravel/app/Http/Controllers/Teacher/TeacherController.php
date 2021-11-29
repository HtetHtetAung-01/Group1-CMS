<?php

namespace App\Http\Controllers\Teacher;

use App\Contracts\Services\Teacher\TeacherServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentFormRequest;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * variables
     */
    private $teacherService;

    /**
     * TeacherController constructor
     * @param $teacherServiceInterface
     * @param $userService
     */
    public function __construct(TeacherServiceInterface $teacherServiceInterface)
    {
        $this->teacherService = $teacherServiceInterface;
    }

    /**
     * To show assignment by teacher ID
     * @param $teacher_id
     * @return view teachers/assignment
     */
    public function showAssignments($teacher_id)
    {
        $courseTitles = $this->teacherService->getAssignmentsByCourse($teacher_id);
        return view('teachers/assignment', compact('courseTitles'));
    }

    /**
     * To show Dashboard view page
     * @param $id
     * @return view teachers/dashboard
     */
    public function showDashboard($id)
    {
        $chartData = $this->teacherService->getChartData();
        $totalStudent = $this->teacherService->getTotalStudent();
        return view('teachers/dashboard', compact('chartData', 'totalStudent'));
    }

    /**
     * To add comment to assignment
     * @param CommentFormRequest $quest
     * @param $id teacher's id
     * @param $assignmentId
     * @return response()->json()
     */
    public function addCommentToAssignment(CommentFormRequest $request, $id, $assignmentId) {
        $validated = $request->validated();
        $this->teacherService->addCommentToAssignment(
                        $validated, $id, $assignmentId);
        return response()->json(['success' => true]);
    }

    /**
     * To download assignment
     * @param $teacher_id
     * @param $student_assignment_id
     * @return teacherService
     */
    public function downloadAssignment($teacher_id, $student_assignment_id) {
        return $this->teacherService->
                downloadStudentAssignment($student_assignment_id);
    }
    
    /**
     * set grade to assignment
     * @param Request $request
     * @return response()->json()
     */
    public function setGrade(Request $request)
    {
       $student_assignment_id = $request->assignment_id;
       $grade = $request->grade;
       $this->teacherService->
                submitGrade($student_assignment_id, $grade);
                
       return response()->json(['success' => true]);
    }

}
