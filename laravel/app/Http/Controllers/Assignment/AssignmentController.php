<?php

namespace App\Http\Controllers\Assignment;

use App\Contracts\Services\Assignment\AssignmentServiceInterface;
use App\Http\Controllers\Controller;
use \App\Http\Requests\FileSubmitRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    /**
     * assignment interface
     */
    private $assignmentInterface;
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AssignmentServiceInterface $assignmentServiceInterface, UserService $userService)
    {
        $this->assignmentInterface = $assignmentServiceInterface;
        $this->userService = $userService;
    }

    /**
     * To check enroll or not
     * @param $course_id
     * @param $student_id
     * @return View courseDetails
     */
    public function isEnrolled($student_id, $course_id)
    {
        $courseDetails = $this->assignmentInterface->getCourseDetails($course_id);
        $isEnrolled = $this->assignmentInterface->isEnrolled($student_id, $course_id);
        $assignmentStatus = $this->isCompletedAssignment($student_id, $course_id);
        $started = $this->showStarted($student_id, $course_id);

        $user = $this->userService->getUserById($student_id);
        $roles = $this->userService->getUserRole($student_id);
        $role = $roles->type;
        info("user = $user->name");
        info("role = $role");
        info("courses ");
        info("courseDetails");
        $enrolledCourse = $this->userService->getEnrolledCourse($student_id, $role);  
        
        return view('course.courseDetails', [
            'courseDetails' => $courseDetails,
            'isEnrolled' => $isEnrolled,
            'assignmentStatus' => $assignmentStatus,
            'started' => $started,
            'user' => $user,
            'role' => $role,
            'enrolledCourse' => $enrolledCourse,
        ]);
    }

    /**
     * To check assignment is completed or not
     * @param $course_id
     * @return View courseDetails
     */
    public function isCompletedAssignment($course_id)
    {
        $assignment_details = $this->assignmentInterface->isCompleted($course_id);
        $key = 0;
        $assignmentStatus = [];
        foreach ($assignment_details as $assignment) {
            $is_completed = DB::table('student_assignments')
                ->select('id', 'uploaded_date', 'file_path')
                ->where('assignment_id', $assignment->id)
                ->whereNull('deleted_at')
                ->get();
            if ($is_completed->count() == 0) {
                $assignmentStatus[$key] = 'progress';
            } else {
                foreach ($is_completed as $com) {
                    if ($com->uploaded_date != NULL && $com->file_path != NULL) {
                        $assignmentStatus[$key] = 'completed';
                    } else {
                        $assignmentStatus[$key] = 'progress';
                    }
                }
            }
            // info("add status $assignmentStatus[$key]");
            $key++;
        }
        return $assignmentStatus;
    }

    /**
     * To show assignment is started or not
     * @param $course_id
     * @param $student_id
     * @return View courseDetails
     */
    public function showStarted($student_id, $course_id)
    {
        $start = [];
        $assignmentList = DB::table('assignments')
            ->select('*')
            ->where('course_id', $course_id)
            ->whereNull('deleted_at')
            ->get();
        info("assignment list = $assignmentList");
        foreach ($assignmentList as $key => $values) {
            info("assignment = " . $assignmentList[$key]->id);
            $start[$key] = $this->assignmentInterface->isStarted($student_id, $assignmentList[$key]->id);
        }
        return $start;
    }

    /**
     * To enroll course by student id
     * @param $course_id
     * @param $student_id
     * @return View courseDetails
     */
    public function enrollCourse($student_id, $course_id)
    {
        $this->assignmentInterface->enrollCourse($student_id, $course_id);
        return back();
    }

    /**
     * To start assignment
     * @param $course_id
     * @param $student_id
     * @param $assignment_id
     * @return View courseDetails
     */
    public function addNullStudentAssignment($student_id, $course_id, $assignment_id)
    {
        $this->assignmentInterface->addNullStudentAssignment($student_id, $course_id, $assignment_id);
        return back();
    }

    /**
     * To download file
     * @param $course_id
     * @param $student_id
     * @param $filename
     * @return View courseDetails
     */
    public function downloadFile($filename)
    {
        return response()->download(storage_path('app/public/' . $filename));
    }

    /**
     * To submit student's assignment
     * @param $course_id
     * @param $student_id
     * @param $assignment_id
     * @param FileSubmitRequest $filename Request form courseDetails
     * @return View courseDetails
     */
    public function addStudentAssignment($student_id, $course_id, $assignment_id, FileSubmitRequest $filename)
    {
        $ROOT_DIR = 'uploads';

        if (!is_dir($ROOT_DIR)) {
            mkdir($ROOT_DIR);
        }
        $validated = $filename->validated();
        $file = $filename->inputfile;
        $inputFileName = Storage::putFileAs($ROOT_DIR, $file, $file->getClientOriginalName());

        $this->assignmentInterface->addStudentAssignment($student_id, $course_id, $assignment_id, $inputFileName);

        return back();
    }
}
