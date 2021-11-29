<?php

namespace App\Dao\StudentAssignment;

use App\Contracts\Dao\StudentAssignment\StudentAssignmentDaoInterface;
use App\Models\StudentAssignment;
use Illuminate\Support\Facades\DB;

class StudentAssignmentDao implements StudentAssignmentDaoInterface
{
    /**
     * To get student's assignment by ID
     * @param string id assignment's id
     * @return object
     */
    public function getStudentAssignmentById($id) {
        return StudentAssignment::find($id);
    }

    /**
     * To upload assignment with assignment id
     * @param string id assignment's id
     */
    public function getUploadedAssignmentsByAssignmentId($assignment_id)
    {
        return DB::select(
            "SELECT S.name, SA.id, SA.uploaded_date, 
            SA.file_path, SA.grade FROM users AS S
            LEFT OUTER JOIN student_assignments AS SA 
            ON S.id = SA.student_id
            WHERE SA.file_path IS NOT NULL
            AND SA.assignment_id = :assignment_id
            AND SA.deleted_at IS NULL;",
            ['assignment_id' => $assignment_id]
        );
    }

    /**
     * To get uploaded assignment with student id and course id
     * @param string $student_id student's id
     * @param string $course_id course's id
     */
    public function getUploadedAssignmentsByStudentAndCourse(
                                        $student_id, $course_id)
    {    
        return DB::select(
            "SELECT SA.* from student_assignments AS SA 
            LEFT OUTER JOIN assignments AS A 
            ON A.id = SA.assignment_id
            LEFT OUTER JOIN courses AS C ON C.id = A.course_id
            WHERE SA.student_id = :student_id AND C.id= :course_id
            AND SA.uploaded_date IS NOT NULL
            AND SA.deleted_at IS NULL;",
            ['student_id' => $student_id, 'course_id' => $course_id]
        );
    }

    /**
     * To get total number of ungraded assignment by assignment id
     * @param string $assignment_id assignment's id 
     */
    public function getTotalCountOfUngradedAssignmentsbyAssignmentId($assignment_id)
    {
        return DB::table('student_assignments')
            ->whereNotNull('file_path')
            ->whereNull('grade')
            ->whereNull('deleted_at')
            ->where('assignment_id', '=', $assignment_id)
            ->count();
    }

    /**
     * get all assignments records of $course_id by $student_id
     * @return $assignmentList
     */
    public function getAssignmentStatusByStudent($student_id, $assignment_id)
    {
        $assignment= DB::table('student_assignments')
                ->select('id', 'uploaded_date', 'file_path')
                ->where('assignment_id', $assignment_id)
                ->where('student_id', $student_id)
                ->whereNull('deleted_at')
                ->get();

        if(count($assignment) == 0)
            $status = 'progress';
        else {
            if($assignment[0]->uploaded_date != NULL && 
                    $assignment[0]->file_path != NULL)
                $status = 'completed';
            else
                $status = 'progress';
        }
        return $status;
    }
}