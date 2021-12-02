<?php

namespace App\Services\Course;

use App\Contracts\Services\Course\CourseServiceInterface;
use App\Dao\Course\CourseDao;
use App\Dao\StudentCourse\StudentCourseDao;
use App\Dao\TeacherCourse\TeacherCourseDao;
use App\Services\Assignment\AssignmentService;

class CourseService implements CourseServiceInterface
{
    /**
     * variables
     */
    private $studentCourseDao;
    private $teacherCourseDao;
    private $courseDao;
    private $assignmentService;

    /**
     * CourseService constructor
     * @param $courseDao, $studentCourseDao, $teacherCourseDao
     */
    public function __construct(
        CourseDao $courseDao,
        StudentCourseDao $studentCourseDao,
        TeacherCourseDao $teacherCourseDao,
        AssignmentService $assignmentService
    ) {
        $this->courseDao = $courseDao;
        $this->studentCourseDao = $studentCourseDao;
        $this->teacherCourseDao = $teacherCourseDao;
        $this->assignmentService = $assignmentService;
    }
    /**
     * get student course list
     * @return $studentCourseList
     */
    public function getStudentCourse()
    {
        return $this->studentCourseDao->getStudentCourse();
    }

    /**
     * get teacher course
     * @param $id
     * @return $teacherCourseList
     */
    public function getTeacherCourse($id)
    {
        return $this->teacherCourseDao->getTeacherCourse($id);
    }

    /**
     * update the is_completed of the table student_courses
     * @param $id, $course_id, $status
     */
    public function updateCourseComplete(
        $student_id,
        $course_id,
        $status
    ) {
        return $this->studentCourseDao->updateCourseComplete($student_id, $course_id, $status);
    }

    /**
     * get the required courses for $course_id
     * @param $course_id
     * @return $requiredCourses
     */
    public function getRequiredCourseID($course_id)
    {
        return $this->courseDao->getRequiredCourseID($course_id);
    }

    /**
     * get the required courses list
     * @param $requiredCourses
     * @return $requiredCourses
     */
    public function getRequiredCourseList($requiredCourses)
    {
        return $this->courseDao->getRequiredCourseList($requiredCourses);
    }

    /**
     * get all the courses
     * @return $courseList
     */
    public function getAllCourseList()
    {
        return $this->courseDao->getAllCourseList();
    }

    /**
     * add new course
     * @param $request
     */
    public function addNewCourse($request)
    {
        return $this->courseDao->addNewCourse($request);
    }

    /**
     * get enrolled courses by student
     * @param $student_id
     * @return $enrolledCourses
     */
    public function getStudentEnrolledCourses($student_id)
    {
        return $this->studentCourseDao->getStudentEnrolledCourses($student_id);
    }

    /**
     * get complete status of course by student
     * @param $student_id, $course_id
     * @return $status
     */
    public function getCourseCompleteStatusByStudent($student_id, $course_id)
    {
        return $this->studentCourseDao->getCourseCompleteStatusByStudent(
            $student_id,
            $course_id
        );
    }

    /**
     * check required courses of $course_id by $student_id are completed or not
     * @param $course_id, student_id
     * @return -> true or false
     */
    private $array = [];
    private $check = [];
    private $i = 0;
    public function isCompletedRequiredCourses($course_id, $student_id)
    {
        $this->array = [];
        $status = null;
        $required_course = $this->courseDao->getRequiredCourseID($course_id);
        foreach($required_course as $course) {
            $status = $this->studentCourseDao->getCourseCompleteStatusByStudent(
                $student_id,
                $course->required_courses
            );
        }
        if($status === 1) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Change string to array
     * @param $text
     * @return $array
     */
    public function changeStringToArray($text)
    {
        $remove_text = str_replace(array('[', ']'), '', $text);
        $array = explode(",", $remove_text);
        return $array;
    }

    /**
     * get status list of student courses
     * @param $student_id, $totalCourse
     * @return $courseStatusList
     */
    public function getCourseStatus($student_id, $totalCourse)
    {
        $enrolledCourseList = $this->studentCourseDao->getStudentEnrolledCourses($student_id);
        $courseStatusList = [];
        foreach ($totalCourse as $key => $value) {
            $isenroll = false;
            foreach ($enrolledCourseList as $enroll) {
                if ($totalCourse[$key] == $enroll->course_id) {
                    $isenroll = true;
                    $assignmentComplete = $this->assignmentService->checkAllAssignmentCompleted(
                        $student_id,
                        $enroll->course_id
                    );

                    if ($assignmentComplete == true) {
                        $this->studentCourseDao->updateCourseComplete(
                            $student_id,
                            $enroll->course_id,
                            1
                        );

                        $courseStatusList[$key] = "completed";
                    } else {
                        $this->studentCourseDao->updateCourseComplete(
                            $student_id,
                            $enroll->course_id,
                            0
                        );

                        if ($this->isCompletedRequiredCourses(
                            $enroll->course_id,
                            $student_id
                        ))
                            $courseStatusList[$key] = "progress";
                        else
                            $courseStatusList[$key] = "unlock next";
                    }
                }
            }
            if (!$isenroll)
                $courseStatusList[$key] = "lock";
        }
        return $courseStatusList;
    }

    /**
     * sort courses in order of completed status
     * @param $statusArray
     * @param $sortingArray
     * @param $decrease
     * @return $newArray
     */
    public function sortCourses($statusArray, $sortingArray, $decrease)
    {
        $index = 1;
        $newArray = [];
        foreach ($statusArray as $key => $value) {
            if ($statusArray[$key] == "completed") {
                $newArray[$index] = $sortingArray[$key - $decrease];
                $index++;
            }
        }
        foreach ($statusArray as $key => $value) {
            if ($statusArray[$key] == "progress") {
                $newArray[$index] = $sortingArray[$key - $decrease];
                $index++;
            }
        }
        foreach ($statusArray as $key => $value) {
            if ($statusArray[$key] == "unlock next") {
                $newArray[$index] = $sortingArray[$key - $decrease];
                $index++;
            }
        }
        foreach ($statusArray as $key => $value) {
            if ($statusArray[$key] == "lock") {
                $newArray[$index] = $sortingArray[$key - $decrease];
                $index++;
            }
        }

        return $newArray;
    }

    /**
     * get all the course id list
     * @return $courseIdList
     */
    public function getAllCourseIdList()
    {
        $courseList = $this->getAllCourseList();
        foreach ($courseList as $key => $value) {
            $courseIdList[++$key] = $value->id;
        }
        return $courseIdList;
    }
    /**
     * get the list of number of assignments 
     * @return $assignmentNoList
     */
    public function getNoOfAssignmentsList()
    {
        $courseIdList = $this->getAllCourseIdList();

        foreach ($courseIdList as $key => $value) {

            $number = $this->assignmentService->getNoOfAssignmentByCourse($courseIdList[$key]);
            $assignmentNoList[$key] = $number;
            $key++;
        }
        return $assignmentNoList;
    }

    /**
     * get the list of number of assignments 
     * @return $assignmentNoList
     */
    public function getCourseListWithAssignmentNo($courseList)
    {    
        $assignmentNoList = $courseList;

        foreach($courseList as $key => $value) {
        $number = $this->assignmentService->
                    getNoOfAssignmentByCourse($courseList[$key]->id);
        $assignmentNoList[$key]->assignmentNo = $number;
        $key++;
        }
        return $assignmentNoList;

    }

    /**
     * search course
     * @return $courseList
     */
    public function getSearchCourseList()
    {
        return $this->courseDao->getSearchCourseList();
    }

    /**
     * search course
     * @return $courseIdList
     */
    public function getSearchCourseIdList($courseList)
    {
        $courseIdList = [];
        $key = 0;
        foreach($courseList as $course) {
        $id = $course->id;
        $courseIdList[++$key] = $id;
        }

        return $courseIdList;
    }
}
