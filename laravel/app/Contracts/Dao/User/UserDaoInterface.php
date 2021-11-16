<?php

namespace App\Contracts\Dao\User;

use Illuminate\Http\Request;

/**
 * Interface of Data Access Object for user
 */
interface UserDaoInterface
{
    /**
      * To create user
      * @return array $userCreate
      */
    public function createUser($data);

    /**
     * To create user
     * @return array $userCreate
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
      * To delete user
      */
    public function editUser($id);

    /**
      * To update user
      */
  public function updateUser($id,$request);

}
