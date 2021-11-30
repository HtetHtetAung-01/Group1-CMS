<?php

namespace App\Http\Controllers\Student;

use App\Contracts\Services\Student\StudentServiceInterface;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    /**
     * variables
     */
    private $studentInterface;

    /**
     * StudentController constructor
     * @param StudentServiceInterface $studentServiceInterface
     */
    public function __construct(StudentServiceInterface $studentServiceInterface)
    {
        $this->studentInterface = $studentServiceInterface;
    }

    /**
     * Show student assignments
     * @param $student_id
     * @return view students/assignment
     */
    public function showAssignments($student_id)
    {
        $courses = $this->studentInterface->getUploadedAssignmentsByStudentId($student_id);
        return view('students/assignment', ['courses' => $courses]);
    }
    
    /**
     * Show student assignments
     * @param $id
     * @return view students/dashboard
     */
    public function showDashboard($id)
    {
        $enrolledData =  $this->studentInterface->getEnrolledData($id); 
        $completedData =  $this->studentInterface->getCompletedData($id); 
        $studentChartData =  $this->studentInterface->getStudentGradeData($id); 
        return view('students/dashboard', [
            'enrolledData' => $enrolledData, 
            'completedData' => $completedData, 
            'studentChartData' => $studentChartData, 
          ]);
    }
}
