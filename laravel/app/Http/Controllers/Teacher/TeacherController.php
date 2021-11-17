<?php

namespace App\Http\Controllers\Teacher;

use App\Contracts\Services\Teacher\TeacherServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentFormRequest;
use App\Services\User\UserService;

class TeacherController extends Controller
{
    private $teacherService;
    private $userService;

    public function __construct(TeacherServiceInterface $teacherServiceInterface, UserService $userService)
    {
        $this->teacherService = $teacherServiceInterface;
        $this->userService = $userService;
    }

    public function showAssignments($teacher_id)
    {
        $courseTitles = $this->teacherService->getAssignmentsByCourse($teacher_id);
        $user = $this->userService->getUserById($teacher_id);
        $roles = $this->userService->getUserRole($teacher_id);
        $role = $roles->type;
        $enrolledCourse = $this->userService->getEnrolledCourse($teacher_id, $role);

        return view('teachers/assignment', compact('user', 'role', 'enrolledCourse', 'courseTitles'));
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
