<?php

namespace App\Contracts\Dao\Comment;

use App\Models\Comment;

interface CommentDaoInterface {

    /**
     * To add comment to an assignment
     * @param Comment $comment assignment's comment
     */
    public function addComment(Comment $comment);

    /**
     * To get comments by assignment id
     * @param string $student_assignment_id student's assignment id
     */
    public function getCommentsbyStudentAssignmentId($student_assignment_id);
}