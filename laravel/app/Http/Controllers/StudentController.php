<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Student\StudentServiceInterface;

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
}
