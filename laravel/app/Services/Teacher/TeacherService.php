<?php

namespace App\Services\Teacher;

use App\Contracts\Dao\Assignment\AssignmentDaoInterface;
use App\Contracts\Dao\Comment\CommentDaoInterface;
use App\Contracts\Dao\StudentAssignment\StudentAssignmentDaoInterface;
use App\Contracts\Dao\TeacherCourse\TeacherCourseDaoInterface;
use App\Contracts\Services\Teacher\TeacherServiceInterface;
use App\Models\Comment;
use App\Models\StudentAssignment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TeacherService implements TeacherServiceInterface
{
    private $commentDao;
    private $assignmentDao;
    private $studentAssignmentDao;
    private $teacherCourseDao;

    public function __construct(
        CommentDaoInterface $commentDao,
        AssignmentDaoInterface $assignmentDao,
        StudentAssignmentDaoInterface $studentAssignmentDao,
        TeacherCourseDaoInterface $teacherCourseDao
    ) {
        $this->commentDao = $commentDao;
        $this->assignmentDao = $assignmentDao;
        $this->studentAssignmentDao = $studentAssignmentDao;
        $this->teacherCourseDao = $teacherCourseDao;
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
        $comment = new Comment;
        $comment->teacher_id = $teacher_id;
        $comment->student_assignment_id = $assignment_id;
        $comment->message = $validated['comment'];
        $this->commentDao->addComment($comment);
    }

    public function downloadStudentAssignment($student_assignment_id)
    {
        echo $student_assignment_id;
        $studentAssignment = $this->studentAssignmentDao
            ->getStudentAssignmentById($student_assignment_id);
        return Storage::download($studentAssignment->file_path);
    }

    public function submitGrade($student_assignment_id, $request)
    {
        $submitGrade = StudentAssignment::FindorFail($student_assignment_id);
        $submitGrade->grade = $request;
        $submitGrade->save();
        return $submitGrade;
    }
}
