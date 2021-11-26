<?php

namespace App\Http\Controllers\Student;

use App\Contracts\Services\Student\StudentServiceInterface;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    private $studentInterface;

    public function __construct(StudentServiceInterface $studentServiceInterface)
    {
        $this->studentInterface = $studentServiceInterface;
    }

    public function showAssignments($student_id)
    {
        $courses = $this->studentInterface->getUploadedAssignmentsByStudentId($student_id);
        return view('students/assignment', compact('courses'));
    }
    
      public function showDashboard($id)
    {
        $enrolledData =  $this->studentInterface->getEnrolledData($id); 
        $completedData =  $this->studentInterface->getCompletedData($id); 
        $studentChartData =  $this->studentInterface->getStudentGradeData($id); 
        return view('students/dashboard', compact('enrolledData', 'completedData', 'studentChartData'));
    }
}
