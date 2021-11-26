<?php

namespace App\Services\Student;

use App\Contracts\Dao\Comment\CommentDaoInterface;
use App\Contracts\Dao\StudentAssignment\StudentAssignmentDaoInterface;
use App\Contracts\Dao\StudentCourse\StudentCourseDaoInterface;
use App\Contracts\Services\Student\StudentServiceInterface;

class StudentService implements StudentServiceInterface
{
    /**
     * variable
     */
    private $studentAssignmentDao;
    private $studentCourseDao;
    private $commentDao;

    /**
     * StudentService constructor
     * @param CommentDaoInterface $commentDao
     * @param StudentCourseDaoInterface $studentCourseDao
     * @param StudentAssignmentDaoInterface $studentAssignmentDao
     */
    public function __construct( CommentDaoInterface $commentDao, 
        StudentCourseDaoInterface $studentCourseDao, 
        StudentAssignmentDaoInterface $studentAssignmentDao)
    {
        $this->commentDao = $commentDao;
        $this->studentAssignmentDao = $studentAssignmentDao;
        $this->studentCourseDao = $studentCourseDao;
    }

    /**
     * get uploaded assignment by student
     * @param $student_id
     * @return $course
     */
    public function getUploadedAssignmentsByStudentId($student_id)
    {
        $courses = $this->studentCourseDao->
                getEnrolledCourseTitlesByStudent($student_id);

        foreach ($courses as $course) {
            $course->assignments = $this->studentAssignmentDao
                ->getUploadedAssignmentsByStudentAndCourse(
                    $student_id, $course->id);

            foreach ($course->assignments as $item) {
                $item->comments = $this->commentDao
                    ->getCommentsbyStudentAssignmentId($item->id);
            }
        }
        
        return $courses;
    }

    /**
     * get student course enrolled data
     * @param $student_id
     */
    public function getEnrolledData($student_id)
    {
        return $this->studentCourseDao->
                    getTotalEnrolledCoursebyStudent($student_id);
    }

    /**
     * get the completed course by student
     * @param $student_id
     */
    public function getCompletedData($student_id)
    {
        return $this->studentCourseDao->
                    getTotalCompletedCoursebyStudent($student_id);
    }

    /**
     * get student grade data for chart
     * @param $student_id
     * @return array $charts
     */
    public function getStudentGradeData($student_id)
    {
      $charts = array();

        // Get Number of Student by Course Title
        $studentPer = $this->studentCourseDao->
                    getStudentPerformanceData($student_id);

        $chartData = "";
        foreach ($studentPer as $item) {
            $chartData .= "['".$item->assignmentName."', "
            . $item->assignmentGrade."],";
        }
        // Remove the last comma and Add to list
        array_push($charts, rtrim($chartData, ","));

        return $charts;
    }
}