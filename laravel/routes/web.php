<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Assignment\AssignmentController;
use App\Http\Controllers\Course\CourseController;
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


//registration
Route::get('dashboard', [AuthController::class, 'userDashboard']);
Route::get('/', [AuthController::class, 'Index'])->name('login');
Route::post('custom-login', [AuthController::class, 'userCustomLogin'])->name('login.custom');
Route::get('registration', [AuthController::class, 'userRegistration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'userCustomRegistration'])->name('register.custom');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

//forgetpassword
Route::get('forget-password', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

//user
Route::middleware(['web', 'auth','logout_back_history'])->group(function () {
    Route::get('/user-list', [AuthController::class, 'showUserList'])->name('userlist');
    Route::delete('/user/{id}', [AuthController::class, 'deleteUser'])->name('user.delete');
    Route::get('/userdetail/{id}', [AuthController::class, 'userDetail'])->name('user.detail');
    Route::get('/useredit/{id}', [AuthController::class, 'editUser'])->name('user.edit');
    Route::post('/update/{id}', [AuthController::class, 'updateUser'])->name('user.update');
});

Route::middleware(['web', 'auth', 'checkstudent','logout_back_history'])->group(function () {
    Route::get('/student/{id}', [UserController::class, 'showLayout'])->name('student-home');
    Route::get('/student/{id}/course', [CourseController::class, 'showStudentCourse'])->name('student.course');
    Route::get('/student/{id}/assignment/', [StudentController::class, 'showAssignments'])->name('student.assignment');
    Route::get('/student/{id}/course/{course_id}', [AssignmentController::class, 'isEnrolled'])->name('student.courseDetail');
    Route::get('/student/{id}/course/{course_id}/enroll', [AssignmentController::class, 'enrollCourse'])->name('student.course.enroll');
    Route::get('/student/{id}/course/{course_id}/assignment/{assignment_id}/download', [AssignmentController::class, 'downloadFile'])->name('student.course.assignment.download');
    Route::post('/student/{id}/course/{course_id}/add/assignment/{assignment_id}', [AssignmentController::class, 'addNullStudentAssignment'])->name('student.course.addAssignment');
    Route::post('/student/{id}/course/{course_id}/update/assignment/{assignment_id}', [AssignmentController::class, 'addStudentAssignment'])->name('student.course.assignment.update');
    Route::get('/student/{id}/dashboard/', [StudentController::class, 'showDashboard'])->name('student.dashboard');
});

Route::middleware(['web', 'auth', 'checkteacher','logout_back_history'])->group(function () {
    Route::get('/teacher/{id}', [UserController::class, 'showLayout'])->name('teacher-home');
    Route::get('/teacher/{id}/assignment/', [TeacherController::class, 'showAssignments'])->name('teacher.assignment');
    Route::get('/teacher/{id}/assignment/{assignment_id}/download/', [TeacherController::class, 'downloadAssignment'])->name('teacher.assignment.download');
    Route::post('/teacher/{id}/assignment/{assignment_id}/comment/', [TeacherController::class, 'addCommentToAssignment'])->name('teacher.assignment.comment');
    Route::get('/setGrade',[TeacherController::class,'setGrade']);
    Route::get('/teacher/{id}/dashboard/', [TeacherController::class, 'showDashboard'])->name('teacher.dashboard');
    Route::get('/teacher/{id}/student-info', [UserController::class, 'showStudentsInfo', 'showLayout'])->name('studentList');
});
