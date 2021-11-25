<?php

namespace App\Http\Controllers\Assignment;

use App\Contracts\Services\Assignment\AssignmentServiceInterface;
use App\Http\Controllers\Controller;
use \App\Http\Requests\FileSubmitRequest;
use App\Services\Course\CourseService;
use App\Services\User\UserService;

class AssignmentController extends Controller
{
    /**
     * assignment interface
     */
    private $assignmentInterface;
    private $userService;
    private $courseService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CourseService $courseService,
        AssignmentServiceInterface $assignmentServiceInterface,
        UserService $userService
    ) {
        $this->courseService = $courseService;
        $this->assignmentInterface = $assignmentServiceInterface;
        $this->userService = $userService;
    }

    /**
     * To check enroll or not
     * @param string $student_id
     * @param string $course_id
     * @return $isEnrolled flag data
     */
    public function isEnrolled($student_id, $course_id)
    {
        $idArray = [];

        $courseDetails = $this->assignmentInterface->getCourseDetails($course_id);
        $isEnrolled = $this->assignmentInterface->isEnrolled($student_id, $course_id);
        $assignmentStatus = $this->isCompletedAssignment($student_id, $course_id);
        $started = $this->showStarted($student_id, $course_id);

        $user = $this->userService->getUserById($student_id);
        $roles = $this->userService->getUserRole($student_id);
        $role = $roles->type;

        // get the required courses list for $course_id
        $requiredCourseID = $this->courseService->getRequiredCourseID($course_id);
        $idArray = app('App\Http\Controllers\Course\CourseController')->changeStringToArray($requiredCourseID[0]->required_courses);
        $requiredCourse = $this->courseService->getRequiredCourseList($idArray);

        $completeRequiredCourse = app('App\Http\Controllers\Course\CourseController')
            ->isCompletedRequiredCourses($course_id, $student_id);
        $enrolledCourse = $this->userService->getEnrolledCourse($student_id, $role);

        return view('course.courseDetails', [
            'courseDetails' => $courseDetails,
            'isEnrolled' => $isEnrolled,
            'assignmentStatus' => $assignmentStatus,
            'started' => $started,
            'user' => $user,
            'role' => $role,
            'enrolledCourse' => $enrolledCourse,
            'completeRequiredCourse' => $completeRequiredCourse,
            'requiredCourse' => $requiredCourse,
        ]);
    }

    /**
     * To check all assignments for $course_id completed or not
     * @param string $student_id
     * @param string $course_id
     * @return $assignmentStatus
     */
    public function isCompletedAssignment($student_id, $course_id)
    {
        $assignment_details = $this->assignmentInterface->isCompleted($course_id);
        $key = 0;
        $assignmentStatus = [];

        foreach ($assignment_details as $assignment) {
            $status = $this->assignmentInterface->getAssignmentStatusByStudent($student_id, $assignment->id);
            $assignmentStatus[$key] = $status;
            $key++;
        }
        return $assignmentStatus;
    }

    /**
     * To show assignment is started or not
     * @param string $course_id
     * @param string $student_id
     * @return $start
     */
    public function showStarted($student_id, $course_id)
    {
        $start = [];
        $assignmentList = $this->assignmentInterface->getAllAssignmentByCourse($course_id);
        foreach ($assignmentList as $key => $values) {
            $start[$key] = $this->assignmentInterface->isStarted($student_id, $assignmentList[$key]->id);
        }
        return $start;
    }

    /**
     * To enroll course by student id
     * @param string $course_id
     * @param string $student_id
     * @return View courseDetails
     */
    public function enrollCourse($student_id, $course_id)
    {
        $this->assignmentInterface->enrollCourse($student_id, $course_id);
        return back();
    }

    /**
     * To start assignment
     * @param string $course_id
     * @param string $student_id
     * @param string $assignment_id
     * @return View courseDetails
     */
    public function addNullStudentAssignment(
        $student_id,
        $course_id,
        $assignment_id
    ) {
        $this->assignmentInterface->addNullStudentAssignment($student_id, $course_id, $assignment_id);
        return back();
    }

    /**
     * To download file
     * @param string $course_id
     * @param string $assignment_id
     * @return View courseDetails
     */
    public function downloadFile(
        $id,
        $course_id,
        $assignment_id
    ) {
        return $this->assignmentInterface->downloadAssignment($assignment_id);
    }

    /**
     * To submit student's assignment
     * @param string $course_id
     * @param string $student_id
     * @param string $assignment_id
     * @param FileSubmitRequest $filename Request form courseDetails
     * @return View courseDetails
     */
    public function addStudentAssignment(
        $student_id,
        $course_id,
        $assignment_id,
        FileSubmitRequest $filename
    ) {
        $this->assignmentInterface->addStudentAssignment($student_id, $course_id, $assignment_id, $filename);
        return back();
    }
}
