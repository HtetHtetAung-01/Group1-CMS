<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assignment\AssignmentController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;

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

Route::get('/student/{id}', [UserController::class, 'showLayout'])->name('student-home');
Route::get('/student/{id}/assignment/', [StudentController::class, 'showAssignments'])->name('student.assignment');
Route::get('/student/{id}/course/{course_id}', [AssignmentController::class, 'isEnrolled'])->name('student.course');
Route::get('/student/{id}/course/{course_id}/enroll', [AssignmentController::class, 'enrollCourse'])->name('student.course.enroll');
Route::get('/student/{id}/course/{course_id}/download/{file_name}', [AssignmentController::class,'downloadFile'])->name('student.course.download');
Route::get('/student/{id}/course/{course_id}/add/assignment/{assignment_id}', [AssignmentController::class, 'addNullStudentAssignment'])->name('student.course.addAssignment');
Route::post('/student/{id}/course/{course_id}/update/assignment/{assignment_id}', [AssignmentController::class, 'addStudentAssignment'])->name('student.courseUpdateAssignment');

Route::get('/teacher/{id}', [UserController::class, 'showLayout'])->name('teacher-home');
Route::get('/teacher/{id}/assignment/', [TeacherController::class, 'showAssignments'])->name('teacher.assignment');
Route::get('/teacher/{id}/assignment/{assignment_id}/download/', [TeacherController::class, 'downloadAssignment'])->name('teacher.assignment.download');
Route::post('/teacher/{id}/assignment/{assignment_id}/comment/', [TeacherController::class, 'addCommentToAssignment'])->name('teacher.assignment.comment');
Route::post('/teacher/{id}/assignment/{assignment_id}/grade', [TeacherController::class, 'submitGrade'])->name('teacher.assignment.grade.submit');
Route::get('/teacher/{id}/student-info', [UserController::class, 'showStudentsInfo', 'showLayout'])->name('studentList');
