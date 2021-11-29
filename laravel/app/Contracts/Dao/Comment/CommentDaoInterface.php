<?php

namespace App\Contracts\Dao\Comment;

interface CommentDaoInterface
{
    /**
     * To add comment to an assignment
     * @param string[] $validated
     * @param string $teacher_id
     * @param string $student_id
     */
    public function addComment($validated, $teacher_id, $assignment_id);

    /**
     * To get comments by assignment id
     * @param string $student_assignment_id student's assignment id
     */
    public function getCommentsbyStudentAssignmentId($student_assignment_id);
}