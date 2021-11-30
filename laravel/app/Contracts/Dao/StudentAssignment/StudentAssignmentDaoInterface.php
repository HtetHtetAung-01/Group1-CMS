<?php

namespace App\Contracts\Dao\StudentAssignment;

interface StudentAssignmentDaoInterface
{
    /**
     * To get student's assignment by ID
     * @param string id assignment's id
     * @return object
     */
    public function getStudentAssignmentById($id);

    /**
     * To upload assignment with assignment id
     * @param string id assignment's id
     */
    public function getUploadedAssignmentsByAssignmentId($assignment_id);

    /**
     * To get uploaded assignment with student id and course id
     * @param string $student_id student's id
     * @param string $course_id course's id
     */
    public function getUploadedAssignmentsByStudentAndCourse($student_id, $course_id);

    /**
     * To get total number of ungraded assignment by assignment id
     * @param string $assignment_id assignment's id 
     */
    public function getTotalCountOfUngradedAssignmentsbyAssignmentId($assignment_id);

    /**
     * get all assignments records of $course_id by $student_id
     * @param $student_id, $assignment_id
     * @return $assignmentList
     */
    public function getAssignmentStatusByStudent($student_id, $assignment_id);
}
