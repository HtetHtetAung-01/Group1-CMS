<?php

namespace App\Http\Controllers\Assignment;

use App\Contracts\Services\Assignment\AssignmentServiceInterface;
use App\Http\Controllers\Controller;
use \App\Http\Requests\FileSubmitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    /**
     * assignment interface
     */
    private $assignmentInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AssignmentServiceInterface $assignmentServiceInterface)
    {
        $this->assignmentInterface = $assignmentServiceInterface;
    }

    /**
     * To get assignment list by course id
     * @param $id 
     * @return View courseDetails
     */
    public function getCourseDetails($id)
    {
        $courseDetails = $this->assignmentInterface->getCourseDetails($id);
        return view('courseDetails', [
            'courseDetails' => $courseDetails
        ]);
    }

    /**
     * To check enroll or not
     * @param $course_id
     * @param $student_id
     * @return View courseDetails
     */
    public function isEnrolled($course_id, $student_id)
    {
        $courseDetails = $this->assignmentInterface->getCourseDetails($course_id);
        $isEnrolled = $this->assignmentInterface->isEnrolled($course_id, $student_id);
        $assignmentStatus = $this->isCompletedAssignment($course_id, $student_id);
        $started = $this->showStarted($course_id, $student_id);
        return view('courseDetails', [
            'courseDetails' => $courseDetails,
            'isEnrolled' => $isEnrolled,
            'assignmentStatus' => $assignmentStatus,
            'started' => $started,
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
    public function showStarted($course_id, $student_id)
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
    public function enrollCourse($course_id, $student_id)
    {
        $this->assignmentInterface->enrollCourse($course_id, $student_id);
        return back();
    }

    /**
     * To start assignment
     * @param $course_id
     * @param $student_id
     * @param $assignment_id
     * @return View courseDetails
     */
    public function addNullStudentAssignment($course_id, $student_id, $assignment_id)
    {
        $this->assignmentInterface->addNullStudentAssignment($course_id, $student_id, $assignment_id);
        return back();
    }

    /**
     * To download file
     * @param $course_id
     * @param $student_id
     * @param $filename
     * @return View courseDetails
     */
    public function downloadFile($course_id, $student_id, $filename)
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
    public function addStudentAssignment($course_id, $student_id, $assignment_id, FileSubmitRequest $filename)
    {
        $ROOT_DIR = 'uploads';

        if (!is_dir($ROOT_DIR)) {
            mkdir($ROOT_DIR);
        }
        $validated = $filename->validated();
        $file = $filename->inputfile;
        $inputFileName = Storage::putFileAs($ROOT_DIR, $file, $file->getClientOriginalName());

        $this->assignmentInterface->addStudentAssignment($course_id, $student_id, $assignment_id, $inputFileName);

        return back();
    }
}
