<?php

use App\Http\Controllers\Admin\AdminController;
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
Route::post('/login', [AuthController::class, 'userCustomLogin'])->name('login-custom');
Route::get('/user/create', [AuthController::class, 'userRegistration'])->name('register-user');
Route::post('/user/create', [AuthController::class, 'userCustomRegistration'])->name('register-custom');
Route::get('/logout', [AuthController::class, 'signOut'])->name('logout');

//forgetpassword
Route::get('forget_password', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget_password', [ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset_password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset_password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

//user
Route::middleware(['web', 'auth','logout_back_history'])->group(function () {
    Route::get('/userdetail/{id}', [AuthController::class, 'userDetail'])->name('user.detail');
    Route::get('/useredit/{id}', [AuthController::class, 'editUser'])->name('user.edit');
    Route::post('/update/{id}', [AuthController::class, 'updateUser'])->name('user.update');
});

Route::middleware(['web', 'auth', 'checkstudent','logout_back_history'])->group(function () {
    Route::get('/student/{id}', [UserController::class, 'showLayout'])->name('student-home');
    Route::get('/student/{id}/course', [CourseController::class, 'showStudentCourse'])->name('student.course');
    Route::get('/student/{id}/assignment/', [StudentController::class, 'showAssignments'])->name('student.assignment');
    Route::get('/student/{id}/course/{course_id}', [AssignmentController::class, 'isEnrolled'])->name('course-detail');
    Route::get('/student/{id}/course/{course_id}/enroll', [AssignmentController::class, 'enrollCourse'])->name('course-enroll');
    Route::post('/student/{id}/course/{course_id}/create/assignment/{assignment_id}', [AssignmentController::class, 'addNullStudentAssignment'])->name('assignment-start');
    Route::post('/student/{id}/course/{course_id}/update/assignment/{assignment_id}', [AssignmentController::class, 'addStudentAssignment'])->name('assignment-submission');
    Route::get('/student/{id}/dashboard/', [StudentController::class, 'showDashboard'])->name('student.dashboard');
});

Route::middleware(['web', 'auth', 'checkstudent'])->group(function () {
    Route::get('/student/{id}/course/{course_id}/assignment/{assignment_id}/download', [AssignmentController::class, 'downloadFile'])->name('assignment-resource');
});

Route::middleware(['web', 'auth', 'checkteacher','logout_back_history'])->group(function () {
    Route::get('/teacher/{id}/assignment/', [TeacherController::class, 'showAssignments'])->name('teacher.assignment');
    Route::post('/teacher/{id}/assignment/{assignment_id}/comment/', [TeacherController::class, 'addCommentToAssignment'])->name('teacher.assignment.comment');
    Route::get('/setGrade',[TeacherController::class,'setGrade']);
    Route::get('/teacher/{id}/dashboard/', [TeacherController::class, 'showDashboard'])->name('teacher.dashboard');
    Route::get('/teacher/{id}/student/list', [UserController::class, 'showStudentsInfo'])->name('studentList');
});

Route::middleware(['web', 'auth', 'checkteacher'])->group(function () {
    Route::get('/teacher/{id}/assignment/{assignment_id}/download/', [TeacherController::class, 'downloadAssignment'])->name('teacher.assignment.download');
});

Route::middleware(['web', 'auth', 'checkadmin', 'logout_back_history'])->group(function () {
// Admin
Route::get('/admin/{id}', [AdminController::class, 'showUserList'])->name('admin-home');
Route::get('/enroll/{teacher_id}',[AdminController::class, 'enrollTeacher'])->name('enroll.teacher');
Route::post('/enroll/{teacher_id}/course',[AdminController::class, 'enrollTeacherCourse'])->name('enroll.teacherCourse');

// Create New Course
Route::get('/course/create', [CourseController::class, 'addNewCourseView'])->name('course-create-view');
Route::post('/course/create', [CourseController::class, 'addNewCourse'])->name('course-create');

Route::get('admin/assignment/{assignment_id}/add', [AdminController::class, 'showAddAssignmentView'])->name('assignment.add');
Route::post('admin/assignment/add', [AdminController::class, 'submitAddAssignmentView'])->name('assignment.add.submit');
});