<?php

namespace App\Contracts\Services\Teacher;

interface TeacherServiceInterface {
    public function getAssignmentsByCourse($teacher_id);
    public function addCommentToAssignment($validated, $teacher_id, $assignment_id);
    public function downloadStudentAssignment($student_assignment_id);
    public function submitGrade($student_assignment_id, $request);
}