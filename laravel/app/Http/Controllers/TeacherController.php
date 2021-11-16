<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Teacher\TeacherServiceInterface;
use App\Http\Requests\CommentFormRequest;

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

    public function addCommentToAssignment(CommentFormRequest $request, $id, $assignmentId) {
        $validated = $request->validated();
        $this->teacherService->addCommentToAssignment($validated, 3, $assignmentId);
        return back();
    }

    public function downloadAssignment($teacher_id, $student_assignment_id) {
        return $this->teacherService->downloadStudentAssignment($student_assignment_id);
    }
}
