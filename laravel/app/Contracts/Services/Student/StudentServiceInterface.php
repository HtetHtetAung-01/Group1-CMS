<?php

namespace App\Contracts\Services\Student;

interface StudentServiceInterface {
    public function getUploadedAssignmentsByStudentId($student_id);
    public function getEnrolledData($student_id); 
    public function getCompletedData($student_id); 
    public function getStudentGradeData($student_id); 
}