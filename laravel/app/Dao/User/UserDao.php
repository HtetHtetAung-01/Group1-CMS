<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Dao\Course\CourseDao;
use Illuminate\Support\Facades\DB;

class UserDao implements UserDaoInterface
{
  private $courseDao;
  public function __construct(CourseDao $courseDao)
  {
    $this->courseDao = $courseDao;
  }
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

  /**
   * get the list of users(role = student) 
   * @return $studentList
   */
  public function getStudent($teacher_id)
  {
    $teacherCourse = $this->courseDao->getEnrolledCourse($teacher_id, 'Teacher');

    $studentList = collect();
    foreach($teacherCourse as $tc) {
      $sList = DB::table('student_course')
                  ->select('*')
                  ->where('course_id', $tc->id)
                  ->whereNull('deleted_at')
                  ->get();

      $studentList->push($sList);            
    }
    return $teacherCourse; 
  }

  /**
   * get the list of users(role = student) who enrolled $teacherCourse
   * @return $studentList
   */
  public function getStudentList($teacherCourse)
  {
    $studentList = collect();
    foreach($teacherCourse as $tc) {
      $sIDList = DB::table('student_courses')
                  ->select('student_id')
                  ->where('course_id', $tc->id)
                  ->whereNull('deleted_at')
                  ->get();
      $sList = collect();
      foreach($sIDList as $id) {
        $student = DB::table('users')
                      ->select('*')
                      ->where('id', $id->student_id)
                      ->whereNull('deleted_at')
                      ->first();

        $sList->push($student);  
      }   
      $studentList->push($sList);            
    }
    return $studentList; 
  }

  /**
   * Get the total number of student by gender
   * @return stdClass total number of student by gender
   */
  public function getTotalStudentByGender() {
    return DB::table("users")
      ->select(DB::raw("gender, COUNT(id) AS total"))
      ->where("role_id", '=', 1)
      ->groupBy('gender')
      ->get();
  }

  /**
     * Get total number of completed courses by student id
     * @return stdClass total number of completed courses by student id
     */
    public function getTotalStudent() {
    
      $totalStudent = DB::select(
          DB::raw("SELECT count(id) as totalStudent
          FROM users
          WHERE role_id=1;"
      ));
      return $totalStudent;
  }
}