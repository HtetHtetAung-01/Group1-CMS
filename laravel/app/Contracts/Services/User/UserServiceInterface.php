<?php

namespace App\Contracts\Services\User;

/**
 * Interface for user service
 */
interface UserServiceInterface
{
  /**
   * get the user by id
   * @param $id
   * @return $user
   */
  public function getUserById($id);

  /**
   * get role of user
   * @param $id
   * @return $role
   */
  public function getUserRole($id);

  /**
   * get the enrolled courses of user
   * @param $id, $role
   * @return $enrolledCourse
   */
  public function getEnrolledCourse($id, $role);

  /**
   * get the list of users(role = student)
   * @param $teacher_id
   * @return $studentList
   */
  public function getStudentList($teacher_id);

  /**
   * To create user
   * @param $data
   * @return array $userCreate
   */
  public function createUser($data);

  /**
   * To save photo
   * @param $profile
   */
  public function savePhoto($profile);

  /**
   * To edit user
   * @param $id
   */
  public function editUser($id);

  /**
   * To update user
   * @param $id, $request
   */
  public function updateUser($id, $request);

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
