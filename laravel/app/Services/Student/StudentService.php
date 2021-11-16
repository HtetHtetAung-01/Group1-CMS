<?php

namespace App\Services\Student;

use App\Contracts\Dao\Comment\CommentDaoInterface;
use App\Contracts\Dao\StudentAssignment\StudentAssignmentDaoInterface;
use App\Contracts\Dao\StudentCourse\StudentCourseDaoInterface;
use App\Contracts\Services\Student\StudentServiceInterface;

class StudentService implements StudentServiceInterface
{
    private $studentAssignmentDao;
    private $studentCourseDao;
    private $commentDao;

    public function __construct( CommentDaoInterface $commentDao, StudentCourseDaoInterface $studentCourseDao, 
        StudentAssignmentDaoInterface $studentAssignmentDao)
    {
        $this->commentDao = $commentDao;
        $this->studentAssignmentDao = $studentAssignmentDao;
        $this->studentCourseDao = $studentCourseDao;
    }

    public function getUploadedAssignmentsByStudentId($student_id)
    {
        $courses = $this->studentCourseDao->getEnrolledCourseTitlesByStudent($student_id);

        foreach ($courses as $course) {
            $course->assignments = $this->studentAssignmentDao
                ->getUploadedAssignmentsByStudentAndCourse($student_id, $course->id);

            foreach ($course->assignments as $item) {
                $item->comments = $this->commentDao
                    ->getCommentsbyStudentAssignmentId($item->id);
            }
        }
        
        return $courses;
    }
}