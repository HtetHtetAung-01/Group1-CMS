<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * variables
     */
    private $userService;

    /**
     * Constructor
     * @param $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * show student information
     * @param $teacher_id
     * @return view teachers.student-info 
     */
    public function showStudentsInfo($teacher_id)
    {
        $teacherCourse = $this->userService
            ->getEnrolledCourse($teacher_id, 'Teacher');
        $studentList = $this->userService
            ->getStudentList($teacherCourse);

        return view('teachers.student_list', [
            'teacherCourse' => $teacherCourse,
            'studentList' => $studentList
        ]);
    }
}
