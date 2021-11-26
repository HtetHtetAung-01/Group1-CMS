<?php

namespace App\Contracts\Dao\Comment;

interface CommentDaoInterface {
    public function addComment($validated, $teacher_id, $assignment_id);
    public function getCommentsbyStudentAssignmentId($student_assignment_id);
}