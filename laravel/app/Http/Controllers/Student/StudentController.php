<?php

namespace App\Http\Controllers\Student;

use App\Contracts\Services\Student\StudentServiceInterface;
use App\Http\Controllers\Controller;
use App\Services\User\UserService;

class StudentController extends Controller
{
    private $studentInterface;
    private $userService;

    public function __construct(StudentServiceInterface $studentServiceInterface, UserService $userService)
    {
        $this->studentInterface = $studentServiceInterface;
        $this->userService = $userService;
    }

    public function showAssignments($student_id)
    {
        $user = $this->userService->getUserById($student_id);
        $roles = $this->userService->getUserRole($student_id);
        $role = $roles->type;
        $enrolledCourse = $this->userService->getEnrolledCourse($student_id, $role);
        $courses = $this->studentInterface->getUploadedAssignmentsByStudentId($student_id);
        return view('students/assignment', compact('user', 'role', 'enrolledCourse', 'courses'));
    }
    
      public function showDashboard($id)
    {
        $user = $this->userService->getUserById($id);
        $roles = $this->userService->getUserRole($id);
        $role = $roles->type;
        $enrolledCourse = $this->userService->getEnrolledCourse($id, $role);

        $enrolledData =  $this->studentInterface->getEnrolledData($id); 
        $completedData =  $this->studentInterface->getCompletedData($id); 
        $studentChartData =  $this->studentInterface->getStudentGradeData($id); 
        return view('students/dashboard', compact('user', 'role', 'enrolledCourse', 'enrolledData', 'completedData', 'studentChartData'));
    }
}
