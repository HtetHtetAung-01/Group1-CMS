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
    private $teacherService;

    public function __construct(TeacherServiceInterface $teacherServiceInterface)
    {
        $this->teacherService = $teacherServiceInterface;
    }

    public function showAssignments($teacher_id)
    {
        $courseTitles = $this->teacherService->getAssignmentsByCourse($teacher_id);
        return view('teachers/assignment', compact('courseTitles'));
    }

    public function showDashboard($id)
    {
        $chartData = $this->teacherService->getChartData();
        $totalStudent = $this->teacherService->getTotalStudent();
        return view('teachers/dashboard', compact('chartData', 'totalStudent'));
    }

    public function addCommentToAssignment(CommentFormRequest $request, $id, $assignmentId) {
        $validated = $request->validated();
        $this->teacherService->addCommentToAssignment($validated, $id, $assignmentId);
        return response()->json(['success' => true]);
    }

    public function downloadAssignment($teacher_id, $student_assignment_id) {
        return $this->teacherService->downloadStudentAssignment($student_assignment_id);
    }
    
    public function setGrade(Request $request)
    {
       $student_assignment_id = $request->assignment_id;
       $grade = $request->grade;
       $this->teacherService->submitGrade($student_assignment_id, $grade);
       return response()->json(['success' => true]);
    }

}
