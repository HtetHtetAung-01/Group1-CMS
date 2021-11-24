<?php

namespace App\Contracts\Dao\StudentAssignment;

interface StudentAssignmentDaoInterface
{
    public function getStudentAssignmentById($id);
    public function getUploadedAssignmentsByAssignmentId($assignment_id);
    public function getUploadedAssignmentsByStudentAndCourse($student_id, $course_id);
    public function getTotalCountOfUngradedAssignmentsbyAssignmentId($assignment_id );

    /**
     * get all assignments records of $course_id by $student_id
     * @return $assignmentList
     */
    public function getAssignmentStatusByStudent($student_id, $assignment_id);
}