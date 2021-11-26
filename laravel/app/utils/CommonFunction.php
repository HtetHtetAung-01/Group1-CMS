<?php

namespace App\utils;

use App\Services\Assignment\AssignmentService;
use App\Services\Course\CourseService;

class CommonFunction
{
    /**
     * variables
     */
    private $courseService;
    private $assignmentService;

    /**
     * CourseService $courseService
     */
    public function __construct(CourseService $courseService, AssignmentService $assignmentService)
    {
        $this->courseService = $courseService;
        $this->assignmentService = $assignmentService;
    }

    /**
     * check required courses of $course_id by $student_id are completed or not
     * @param $course_id, student_id
     * @return -> true or false
     */
    private $array = [];
    private $i = 0;
    public function isCompletedRequiredCourses($course_id, $student_id)
    {
        $this->array = [];
        $this->i ++ ;
        $required_course = $this->courseService->getRequiredCourseID($course_id);
        foreach($required_course as $course) {
        if($course->required_courses == null && count($this->array) == 0) {
            return true;
        }
        $this->array = $this->changeStringToArray($course->required_courses);;
        foreach($this->array as $key => $value) {
            $status  = $this->courseService->getCourseCompleteStatusByStudent($student_id, $this->array[$key]);

            if($status == NULL) {
            return false;
            }
            else if($status == 0) {
            return false;
            }
            else {
            return $this->isCompletedRequiredCourses($this->array[$key], $student_id);
            }
        }
        return true;
        }
    }

    /**
     * Change string to array
     * @param $text
     * @return $array
     */
    public function changeStringToArray($text)
    {
        $remove_text = str_replace(array('[',']'), '', $text);
        $array = explode(",", $remove_text);
        return $array;
    }

    /**
     * To check all assignments for $course_id completed or not
     * @param $course_id
     * @return $assignmentStatus
     */
    public function isCompletedAssignment($student_id, $course_id)
    {
        $assignment_details = $this->assignmentService->isCompleted($course_id);
        $key = 0;
        $assignmentStatus = [];

        foreach ($assignment_details as $assignment) {
            $status = $this->assignmentService->getAssignmentStatusByStudent($student_id, $assignment->id);
            $assignmentStatus[$key] = $status;
            $key++;
        }
        return $assignmentStatus;
    }
}