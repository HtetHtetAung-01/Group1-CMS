<?php

namespace App\Contracts\Dao\Comment;

use App\Models\Comment;

interface CommentDaoInterface {
    public function addComment(Comment $comment);
    public function getCommentsbyStudentAssignmentId($student_assignment_id);
}