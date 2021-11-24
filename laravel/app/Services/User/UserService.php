<?php

namespace App\Services\User;

use App\Dao\Course\CourseDao;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Dao\User\UserDao;
use App\Contracts\Services\User\UserServiceInterface;


class UserService implements UserServiceInterface
{
    /**
     * @var $userDao
     */
    private $userDao;
    private $courseDao;

    /**
     * UserServices constructor,
     * 
     * @param UserDao $userDao
     */

    public function __construct(UserDao $userDao, CourseDao $courseDao)
    {
        $this->userDao=$userDao;
        $this->courseDao = $courseDao;
    }
    public function createUser($data){
        return $this->userDao->createUser($data);
    }

    public function savePhoto($profile){
        return $this->userDao->savePhoto($profile);
    }

    public function getUserList($request){
        return $this->userDao->getUserList($request);
    }

    public function deleteUser($id)
    {
        return $this->userDao->deleteUser($id);
    }

    public function editUser($id)
    {
        return $this->userDao->editUser($id);
    }

    public function updateUser($id, $request)
    {
        return $this->userDao->updateUser($id,$request);
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

  /**
   * get the list of users(role = student)
   * @return $studentList
   */
  public function getStudentList($teacher_id)
  {
    $studentList = $this->userDao->getStudentList($teacher_id);
    return $studentList;
  }

  /**
	 * Get all the user list
	 * @return $userList
	 */
	public function getAllUser()
	{
		return $this->userDao->getAllUser();
	}

	/**
	 * Get all the student list
	 * @return $studentList
	 */
	public function getAllStudent()
	{
        return $this->userDao->getAllStudent();
	}

	/**
	 * Get all the teacher list
	 * @return $teacherList
	 */
	public function getAllTeacher()
	{
        return $this->userDao->getAllTeacher();
	}
}