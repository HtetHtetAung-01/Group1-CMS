<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgetPasswordController;

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

//registration
Route::get('dashboard', [AuthController::class, 'userDashboard']); 
Route::get('login', [AuthController::class, 'Index'])->name('login');
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
Route::get('/user-list', [AuthController::class, 'showUserList']); 
Route::delete('/user/{id}', [AuthController::class, 'deleteUser']);
Route::get('/userdetail/{id}', [AuthController::class, 'userDetail']); 
Route::get('/useredit/{id}', [AuthController::class, 'editUser']); 
Route::post('/update/{id}',[AuthController::class, 'updateUser']);