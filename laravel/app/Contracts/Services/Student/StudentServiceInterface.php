<?php

namespace App\Contracts\Services\Student;

interface StudentServiceInterface
{

    /**
     * get uploaded assignment by student
     * @param $student_id
     * @return $course
     */
    public function getUploadedAssignmentsByStudentId($student_id);

    /**
     * get student course enrolled data
     * @param $student_id
     */
    public function getEnrolledData($student_id);

    /**
     * get the completed course by student
     * @param $student_id
     */
    public function getCompletedData($student_id);

    /**
     * get student grade data for chart
     * @param $student_id
     * @return array $charts
     */
    public function getStudentGradeData($student_id);
}
