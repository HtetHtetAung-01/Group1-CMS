<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assignment\AssignmentController;

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

Route::get('/{id}', [UserController::class, 'showLayout'])->name('home');
Route::get('/{teacher_id}/Teacher/student-info', [UserController::class, 'showStudentsInfo', 'showLayout'])->name('studentList');

Route::get('Teacher/{id}/dashboard/', [TeacherController::class, 'showDashboard']);

Route::get('/Student/{id}/dashboard/', [StudentController::class, 'showDashboard']);