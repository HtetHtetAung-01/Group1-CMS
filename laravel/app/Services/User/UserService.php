<?php

namespace App\Services\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Dao\Course\CourseDao;
use App\Dao\User\UserDao;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{
  private $userDao;
  private $courseDao;

  public function __construct(UserDao $userDao, CourseDao $courseDao)
  {
    $this->userDao = $userDao;
    $this->courseDao = $courseDao;
  }

  /**
   * get the user by id
   * @return $user
   */
  public function getUserById($id)
  {
    $user = $this->userDao->getUserById($id);
    return $user;
  }

  /**
   * get role of user
   * @return $role
   */
  public function getUserRole($id)
  {
    $role = $this->userDao->getUserRole($id);
    return $role;
  }

  /**
   * get the enrolled enroll$enrolledCourse of user
   * @return $enrolledCourse
   */
  public function getEnrolledCourse($id, $role)
  {
    $enrolledCourse = $this->courseDao->getEnrolledCourse($id, $role);
    return $enrolledCourse;
  }
}