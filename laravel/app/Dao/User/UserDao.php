<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use Illuminate\Support\Facades\DB;

class UserDao implements UserDaoInterface
{
  /**
   * get the user by id
   * @return $user
   */
  public function getUserById($id)
  {
    $user = DB::table('users')->where('id', $id)->first();
    return $user;
  }

  /**
   * get role of user
   * @return $role
   */
  public function getUserRole($id)
  {
    $user = $this->getUserById($id);
    $role = DB::table('user_role')
              ->select('*')
              ->where('id', $user->role_id)
              ->whereNull('deleted_at')
              ->first();
    return $role;
  }
}