<?php

namespace App\Dao\StudentAssignment;

use App\Contracts\Dao\StudentAssignment\StudentAssignmentDaoInterface;
use App\Models\StudentAssignment;
use Illuminate\Support\Facades\DB;

class StudentAssignmentDao implements StudentAssignmentDaoInterface
{
    public function getStudentAssignmentById($id) {
        return StudentAssignment::find($id);
    }

    public function getUploadedAssignmentsByAssignmentId($assignment_id)
    {
        return DB::select(DB::raw(
            "SELECT S.name, SA.id, SA.uploaded_date, SA.file_path, SA.grade FROM users AS S
            LEFT OUTER JOIN student_assignments AS SA ON S.id = SA.student_id
            WHERE SA.file_path IS NOT NULL
            AND SA.assignment_id = $assignment_id
            AND SA.deleted_at IS NULL;"
        ));
    }

    public function getUploadedAssignmentsByStudentAndCourse($student_id, $course_id)
    {    
        return DB::select(DB::raw(
            "SELECT SA.* from student_assignments AS SA 
            LEFT OUTER JOIN assignments AS A ON A.id = SA.assignment_id
            LEFT OUTER JOIN courses AS C ON C.id = A.course_id
            WHERE SA.student_id = $student_id AND C.id= $course_id
            AND SA.uploaded_date IS NOT NULL
            AND SA.deleted_at IS NULL;"
        ));
    }

    public function getTotalCountOfUngradedAssignmentsbyAssignmentId($assignment_id)
    {
        return DB::table('student_assignments')
            ->whereNotNull('file_path')
            ->whereNull('grade')
            ->whereNull('deleted_at')
            ->where('assignment_id', '=', $assignment_id)
            ->count();
    }
}