<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;

class UserController extends Controller
{
  private $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  public function showLayout($id)
  {
    $user = $this->userService->getUserById($id);
    $roles = $this->userService->getUserRole($id);
    $role = $roles->type;
    $enrolledCourse = $this->userService->getEnrolledCourse($id, $role);   
    info("enrolled courses");
    info($enrolledCourse);
    foreach($enrolledCourse as $course) {
      info("title = $course->title");
    } 

    return view('layouts.app', compact('user', 'role', 'enrolledCourse'));
  }
}
