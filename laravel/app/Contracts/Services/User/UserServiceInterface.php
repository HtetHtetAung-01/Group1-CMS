<?php

namespace App\Contracts\Services\User;


interface UserServiceInterface
{
  /**
   * get the user by id
   * @return $user
   */
  public function getUserById($id);

  /**
   * get role of user
   * @return $role
   */
  public function getUserRole($id);

  /**
   * get the enrolled courses of user
   * @return $enrolledCourse
   */
  public function getEnrolledCourse($id, $role);
}