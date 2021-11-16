<?php

namespace App\Contracts\Dao\StudentAssignment;

interface StudentAssignmentDaoInterface
{
    public function getStudentAssignmentById($id);
    public function getUploadedAssignmentsByAssignmentId($assignment_id);
    public function getUploadedAssignmentsByStudentAndCourse($student_id, $course_id);
    public function getTotalCountOfUngradedAssignmentsbyAssignmentId($assignment_id );
}