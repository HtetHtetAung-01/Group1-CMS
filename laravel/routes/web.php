<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assignment\AssignmentController;
use App\Http\Controllers\Course\CourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::get('/course/{course_id}', [AssignmentController::class, 'getCourseDetails']);
Route::get('/course/{course_id}/student/{student_id}', [AssignmentController::class, 'isEnrolled']);
Route::get('/course/{course_id}/student/{student_id}/enroll', [AssignmentController::class, 'enrollCourse']);
Route::get('/course/{course_id}/student/{student_id}/download/{file_name}', [AssignmentController::class,'downloadFile']);
Route::get('/course/{course_id}/student/{student_id}/add/assignment/{assignment_id}', [AssignmentController::class, 'addNullStudentAssignment']);
Route::post('/course/{course_id}/student/{student_id}/update/assignment/{assignment_id}', [AssignmentController::class, 'addStudentAssignment']);

Route::get('/student/{id}/assignment/', [StudentController::class, 'showAssignments']);
Route::get('/teacher/{id}/assignment/', [TeacherController::class, 'showAssignments']);
Route::get('/teacher/{id}/assignment/{assignment_id}/download/', [TeacherController::class, 'downloadAssignment']);
Route::post('/teacher/{id}/assignment/{assignment_id}/comment/', [TeacherController::class, 'addCommentToAssignment']);

Route::get('/teacher/{id}', [UserController::class, 'showLayout'])->name('teacher.home');
Route::get('/student/{id}', [UserController::class, 'showLayout'])->name('student.home');
Route::get('/{teacher_id}/teacher/student-info', [UserController::class, 'showStudentsInfo', 'showLayout'])->name('studentList');

Route::get('/teacher/{teacher_id}/course', [CourseController::class, 'showTeacherCourse'])->name('teacher.course');
Route::get('/student/{student_id}/course', [CourseController::class, 'showStudentCourse'])->name('student.course');


