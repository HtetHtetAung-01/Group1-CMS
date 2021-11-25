<?php

namespace App\Dao\Comment;

use App\Contracts\Dao\Comment\CommentDaoInterface;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentDao implements CommentDaoInterface
{
    /**
     * To add comment to an assignment
     * @param Comment $comment assignment's comment
     */
    public function addComment(Comment $comment) {
        $comment->save();
    }
    
    /**
     * To get comments by assignment id
     * @param string $student_assignment_id student's assignment id
     */
    public function getCommentsbyStudentAssignmentId($id)
    {
        return DB::select(DB::raw(
            "SELECT T.name, C.message FROM comments AS C
            LEFT OUTER JOIN users AS T ON T.id = C.teacher_id
            WHERE C.student_assignment_id = $id;"
        ));
    }
}
