<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Dao\User\UserDao;
use App\Contracts\Services\User\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var $userDao
     */
    protected $userDao;

    /**
     * UserServices constructor,
     * 
     * @param UserDao $userDao
     */

    public function __construct(UserDaoInterface $userDaoInterface)
    {
        $this->userDaoInterface=$userDaoInterface;
    }
    public function createUser($data){
        return $this->userDaoInterface->createUser($data);
    }

    public function savePhoto($profile){
        return $this->userDaoInterface->savePhoto($profile);
    }

    public function getUserList($request){
        return $this->userDaoInterface->getUserList($request);
    }

    public function deleteUser($id)
    {
        return $this->userDaoInterface->deleteUser($id);
    }

    public function editUser($id)
    {
        return $this->userDaoInterface->editUser($id);
    }

    public function updateUser($id, $request)
    {
        return $this->userDaoInterface->updateUser($id,$request);
    }
}