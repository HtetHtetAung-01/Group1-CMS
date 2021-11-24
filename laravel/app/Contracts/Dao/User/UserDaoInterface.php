<?php

namespace App\Contracts\Dao\User;

use Illuminate\Http\Request;

/**
 * Interface of Data Access Object for user
 */
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

	/**
	 * get the list of users(role = student) who enrolled $courseList
	 * @return $studentList
	 */
	public function getStudentList($courseList);

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
	public function updateUser($id, $request);

	/**
	 * Get the total number of student by gender
	 * @return stdClass total number of student by gender
	 */
	public function getTotalStudentByGender();

	public function getTotalStudent();

	/**
	 * Get all the user list
	 * @return $userList
	 */
	public function getAllUser();

	/**
	 * Get all the student list
	 * @return $studentList
	 */
	public function getAllStudent();

	/**
	 * Get all the teacher list
	 * @return $teacherList
	 */
	public function getAllTeacher();
}
