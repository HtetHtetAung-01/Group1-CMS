<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Teacher\TeacherServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Requests\CommentFormRequest;

class TeacherController extends Controller
{
    private $teacherService;
    private $userService;

    public function __construct(TeacherServiceInterface $teacherServiceInterface,
        UserServiceInterface $userServiceInterface)
    {
        $this->teacherService = $teacherServiceInterface;
        $this->userService = $userServiceInterface;
    }

    public function showAssignments($teacher_id)
    {
        $courseTitles = $this->teacherService->getAssignmentsByCourse($teacher_id);

        return view('teachers/assignment', compact('courseTitles'));
    }

    public function showDashboard($id)
    {
        $user = $this->userService->getUserById($id);
        $roles = $this->userService->getUserRole($id);
        $role = $roles->type;
        $enrolledCourse = $this->userService->getEnrolledCourse($id, $role);

        $chartData = $this->teacherService->getChartData();
        $totalStudent = $this->teacherService->getTotalStudent();
    
        return view('teachers/dashboard', compact('user', 'role', 'enrolledCourse', 'chartData', 'totalStudent'));
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
