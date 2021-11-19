<?php

namespace App\Contracts\Services\User;

use Illuminate\Http\Request;

/**
 * Interface for user service
 */
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

  /**
   * get the list of users(role = student)
   * @return $studentList
   */
  public function getStudentList($teacher_id);
  
  /**
   * To create user
   * @return array $userCreate
   */
  public function createUser($data);

   /**
   * To save photo
   */
  public function savePhoto($profile);

  /**
    * To get userList
    */
  public function getUserList($request);

  /**
    * To delete user
    */
  public function deleteUser($id);

  /**
    * To edit user
    */
  public function editUser($id);

  /**
    * To update user
    */
  public function updateUser($id,$request);
    
}