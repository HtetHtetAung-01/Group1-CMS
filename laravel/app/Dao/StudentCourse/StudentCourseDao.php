<?php

namespace App\Dao\StudentCourse;

use App\Contracts\Dao\StudentCourse\StudentCourseDaoInterface;
use Illuminate\Support\Facades\DB;

class StudentCourseDao implements StudentCourseDaoInterface
{
    public function getEnrolledCourseTitlesByStudent($student_id)
    {
        $courseTitles = DB::select(
            DB::raw("SELECT C.id, C.title FROM courses AS C
            LEFT OUTER JOIN student_courses AS SC ON SC.course_id = C.id
            WHERE SC.student_id = $student_id;"
        ));

        return $courseTitles;
    }

    /**
     * Get total number of student by courses title
     * @return stdClass total number of student by courses title
     */
    public function getTotalStudentByCourseTitle() {
        return DB::table("student_courses AS SC")
            ->select(DB::raw('C.title, count(SC.student_id) AS total'))
            ->leftJoin('courses AS C', "C.id", '=', 'SC.course_id')
            ->groupBy('SC.course_id')
            ->get();
    }

    /**
     * Get total number of enrolled courses by student id
     * @return stdClass total number of enrolled courses by student id
     */
    public function getTotalEnrolledCoursebyStudent($student_id) {
    
        $totalEnrolledCourse = DB::select(
            DB::raw("SELECT count(course_id) as totalEnrolledCourse, student_id 
            FROM student_courses
            WHERE student_id =".$student_id.";"
        ));

        return $totalEnrolledCourse;
    }

    /**
     * Get total number of completed courses by student id
     * @return stdClass total number of completed courses by student id
     */
    public function getTotalCompletedCoursebyStudent($student_id) {
    
        $totalCompletedCourse = DB::select(
            DB::raw("SELECT count(course_id) as totalCompletedCourse, student_id 
            FROM student_courses
            WHERE is_completed=1 AND student_id =". $student_id.";"
        ));
        return $totalCompletedCourse;
    }

    /**
     * Get StudentPerformanceData
     * @return stdClass getStudentPerformanceData
     */
    public function getStudentPerformanceData($student_id) {

            $studentPerformance = DB::select(
                DB::raw("SELECT SC.student_id, SC.course_id, C.title as courseTitle, 
                A.id as assignmentID, A.name as assignmentName, SA.grade as assignmentGrade
                FROM student_courses AS SC
                LEFT JOIN courses AS C ON C.id = SC.course_id
                LEFT JOIN assignments AS A ON C.id = A.course_id
                LEFT JOIN student_assignments AS SA ON SA.assignment_id = A.id
                WHERE SC.student_id = $student_id AND SA.student_id = $student_id AND SA.grade IS NOT NULL;")
              );
              return $studentPerformance;
    }

    /**
     * get student course list
     * @return $studentCourseList
     */
    public function getStudentCourse()
    {
        $courseList = DB::table('courses')->select('*')->whereNull('deleted_at')->get();
        return $courseList;
    }
}
