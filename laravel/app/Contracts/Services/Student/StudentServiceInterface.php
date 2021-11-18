<?php

namespace App\Contracts\Services\Student;

interface StudentServiceInterface {
    public function getUploadedAssignmentsByStudentId($student_id);
}