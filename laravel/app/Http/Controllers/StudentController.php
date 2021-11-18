<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Student\StudentServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;

class StudentController extends Controller
{
    private $studentInterface;
    private $userService;

    public function __construct(StudentServiceInterface $studentServiceInterface, UserServiceInterface $userServiceInterface)
    {
        $this->studentInterface = $studentServiceInterface;
        $this->userService = $userServiceInterface;
    }

    public function showAssignments($student_id)
    {
        $courses = $this->studentInterface->getUploadedAssignmentsByStudentId($student_id);
        return view('students/assignment', compact('courses'));
    } 
    
    public function showDashboard($id)
    {
        $user = $this->userService->getUserById($id);
        $roles = $this->userService->getUserRole($id);
        $role = $roles->type;
        $enrolledCourse = $this->userService->getEnrolledCourse($id, $role);

        $enrolledData =  $this->studentInterface->getEnrolledData($id); //Htet
        $completedData =  $this->studentInterface->getCompletedData($id); //Htet
        $studentChartData =  $this->studentInterface->getStudentGradeData($id); //Htet
        // print_r($studentChartData);
        return view('students/dashboard', compact('user', 'role', 'enrolledCourse', 'enrolledData', 'completedData', 'studentChartData'));
    
    }
}
