<?php

namespace App\Services\Teacher;

use App\Contracts\Dao\Assignment\AssignmentDaoInterface;
use App\Contracts\Dao\Comment\CommentDaoInterface;
use App\Contracts\Dao\StudentAssignment\StudentAssignmentDaoInterface;
use App\Contracts\Dao\StudentCourse\StudentCourseDaoInterface;
use App\Contracts\Dao\TeacherCourse\TeacherCourseDaoInterface;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\Teacher\TeacherServiceInterface;
use App\Models\Comment;
use App\Models\StudentAssignment;
use Illuminate\Support\Facades\Storage;

class TeacherService implements TeacherServiceInterface
{
    private $assignmentDao;
    private $commentDao;
    private $studentAssignmentDao;
    private $studentCourseDao;
    private $teacherCourseDao;
    private $userDao;

    public function __construct( 
        AssignmentDaoInterface $assignmentDao, 
        CommentDaoInterface $commentDao,
        StudentAssignmentDaoInterface $studentAssignmentDao, 
        StudentCourseDaoInterface $studentCourseDao,
        TeacherCourseDaoInterface $teacherCourseDao,
        UserDaoInterface $userDao)
    {
        $this->assignmentDao = $assignmentDao;
        $this->commentDao = $commentDao;
        $this->studentAssignmentDao = $studentAssignmentDao;
        $this->studentCourseDao = $studentCourseDao;
        $this->teacherCourseDao = $teacherCourseDao;
        $this->userDao = $userDao;
    }

    public function getAssignmentsByCourse($teacher_id)
    {
        $courseTitles = $this->teacherCourseDao->getEnrolledCoursesByTeacher($teacher_id);

        foreach ($courseTitles as $title) {
            $title->assignments = $this->assignmentDao
                ->getAssignmentNamesByCourseId($title->id);

            foreach ($title->assignments as $assignment) {

                $assignment->assignmentList =
                    $this->studentAssignmentDao->getUploadedAssignmentsByAssignmentId($assignment->id);

                $assignment->numOfUngradedAssignment =
                    $this->studentAssignmentDao->getTotalCountOfUngradedAssignmentsbyAssignmentId($assignment->id);

                foreach ($assignment->assignmentList as $item) {
                    $item->comments = $this->commentDao->getCommentsbyStudentAssignmentId($item->id);
                }
            }
        }

        return $courseTitles;
    }

    public function addCommentToAssignment($validated, $teacher_id, $assignment_id)
    {
        $this->commentDao->addComment($validated, $teacher_id, $assignment_id);
    }

    public function downloadStudentAssignment($student_assignment_id)
    {
        $studentAssignment = $this->studentAssignmentDao
            ->getStudentAssignmentById($student_assignment_id);
        return Storage::download($studentAssignment->file_path);
    }

    public function getChartData()
    {
        $charts = array();

        // Get Number of Student by Course Title
        $numStudentByCourseTitle = $this->studentCourseDao->getTotalStudentByCourseTitle();
        $chartData = "";
        foreach ($numStudentByCourseTitle as $item) {
            $chartData .= "['".$item->title."', ". $item->total."],";
        }
        // Remove the last comma and Add to list
        array_push($charts, rtrim($chartData, ","));

        // Get number of student by Gender
        $numStudentByGender = $this->userDao->getTotalStudentByGender();
        $chartData = "";
        foreach ($numStudentByGender as $item) {
            $chartData .= "['".$item->gender."', ". $item->total."],";
        }
        // Remove the last comma and Add to list
        array_push($charts, rtrim($chartData, ","));

        return $charts;
    }

    public function getTotalStudent()
    {
        return $this->userDao->getTotalStudent();
    }
    
    public function submitGrade($student_assignment_id, $request)
    {
        $submitGrade = StudentAssignment::FindorFail($student_assignment_id);
        $submitGrade->grade = $request;
        $submitGrade->save();
        return $submitGrade;
    }
}
