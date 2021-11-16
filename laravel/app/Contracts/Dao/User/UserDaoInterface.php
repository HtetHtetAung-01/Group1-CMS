<?php

namespace App\Contracts\Dao\User;


interface UserDaoInterface
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
}