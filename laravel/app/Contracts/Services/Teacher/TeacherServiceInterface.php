<?php

namespace App\Contracts\Services\Teacher;

interface TeacherServiceInterface
{
    /**
     * get assignments by teacher's courses
     * @param $teacher_id
     * @return $courseTitles
     */
    public function getAssignmentsByCourse($teacher_id);

    /**
     * add comment to assignment by teacher
     * @param $validated
     * @param $teacher_id
     * @param $assignment_id
     */
    public function addCommentToAssignment($validated, $teacher_id, $assignment_id);

    /**
     * download student assignments
     * @param $student_assignment_id
     * @return Storage
     */
    public function downloadStudentAssignment($student_assignment_id);

    /**
     * get chart data
     * @return array $charts
     */
    public function getChartData();

    /**
     * get assignments by teacher's courses
     * @return stdClass total number of completed courses by student id
     */
    public function getTotalStudent();

    /**
     * submit grade 
     * @param $student_assignment_id
     * @param $request
     * @return $submitGrade
     */
    public function submitGrade($student_assignment_id, $request);
}
