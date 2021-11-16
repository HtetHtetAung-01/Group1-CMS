<?php

namespace App\Dao\Assignment;

use App\Contracts\Dao\Assignment\AssignmentDaoInterface;
use Illuminate\Support\Facades\DB;

class AssignmentDao implements AssignmentDaoInterface
{
    public function getAssignmentNamesbyCourseId($course_id) {
        return DB::select(DB::raw(
            "SELECT A.id, A.name FROM assignments AS A
            LEFT OUTER JOIN courses AS C ON C.id = A.course_id 
            WHERE C.id = $course_id;"
        ));
    }
}