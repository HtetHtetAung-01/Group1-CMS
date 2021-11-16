<?php

namespace App\Contracts\Services\User;

use Illuminate\Http\Request;

/**
 * Interface for user service
 */
interface UserServiceInterface
{
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