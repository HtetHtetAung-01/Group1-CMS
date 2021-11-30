<?php

namespace App\Services\User;

use App\Dao\Course\CourseDao;
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
     * UserServices constructor
     * @param UserDao $userDao
     */
    public function __construct(UserDao $userDao, CourseDao $courseDao)
    {
        $this->userDao=$userDao;
        $this->courseDao = $courseDao;
    }

    /**
	 * create new user 
	 * @param $data
	 * @return $user
	 */
    public function createUser($data){
        return $this->userDao->createUser($data);
    }

    /**
	 * save user profile phpto
	 * @param $profile
	 * @return $imagePath
	 */
    public function savePhoto($profile){
        return $this->userDao->savePhoto($profile);
    }

    /**
	 * Edit user info
	 * @param $id
	 * @return $userEdit
	 */
    public function editUser($id)
    {
        return $this->userDao->editUser($id);
    }

    /**
	 * Update user info
	 * @param $id, $request
	 * @return $userInformation
	 */
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
    $enrolledCourse = $this->courseDao->
                    getEnrolledCourse($id, $role);
    return $enrolledCourse;
  }

  /**
   * get the list of users(role = student)
   * @return $studentList
   */
  public function getStudentList($teacher_id)
  {
    $studentList = $this->userDao->
                    getStudentList($teacher_id);
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