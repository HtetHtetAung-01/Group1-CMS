<?php

namespace App\Dao\Comment;

use App\Contracts\Dao\Comment\CommentDaoInterface;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentDao implements CommentDaoInterface
{
    public function addComment($validated, $teacher_id, $assignment_id)
    {
        $comment = new Comment;
        $comment->teacher_id = $teacher_id;
        $comment->student_assignment_id = $assignment_id;
        $comment->message = $validated['comment'];
        $comment->save();
    }
    
    public function getCommentsbyStudentAssignmentId($id)
    {
        return DB::select(
            "SELECT T.name, C.message FROM comments AS C
            LEFT OUTER JOIN users AS T ON T.id = C.teacher_id
            WHERE C.student_assignment_id = $id;"
        );
    }
}
