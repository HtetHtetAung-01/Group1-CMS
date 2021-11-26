<?php

namespace App\Dao\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Dao\Course\CourseDao;
use Illuminate\Support\Facades\DB;

class UserDao implements UserDaoInterface
{
	/**
	 * @var User
	 */
	protected $user;
	private $courseDao;

	/**
	 * UserDao constructor,
	 * 
	 * @param User $user
	 */

	public function __construct(User $user, CourseDao $courseDao)
	{
		$this->user = $user;
		$this->courseDao = $courseDao;
	}

	public function createUser($data)
	{
		$profile = $data['profile_path'];

		$user = User::create([
			'name' => $data['name'],
			'profile_path' => $this->savePhoto($profile),
			'dob' => $data['dob'],
			'gender' => $data['gender'],
			'role_id' => $data['role_id'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'phone' => $data['phone'],
			'address' => $data['address'],
		]);
		return $user;
	}

	public function savePhoto($profile)
	{
		$profileName = $profile->getClientOriginalName();
		$imagePath  = "storage/photos/" . $profileName;
		$profile->storeAs('/public/photos', $profileName);
		return $imagePath;
	}

	public function getUserList($request)
	{
		$userLists = User::all();
		return $userLists;
	}

	public function deleteUser($id)
	{
		User::findOrFail($id)->delete();
	}

	public function editUser($id)
	{
		$userEdit = User::find($id);
		return $userEdit;
	}

	public function updateUser($id, $request)
	{
		$userinformation = User::find($id);
		$userinformation->name = $request->name;
		if ($request->is_update == 1) {
			$profile = $request->profile_path;
			$userinformation->profile_path = $this->savePhoto($profile);
		}

		$userinformation->dob = $request->dob;
		$userinformation->gender = $request->gender;
		$userinformation->role_id = $request->role_id;
		$userinformation->email = $request->email;
		$userinformation->address = $request->address;
		$userinformation->phone = $request->phone;
		$userinformation->save();
		return $userinformation;
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
		foreach ($teacherCourse as $tc) {
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
		foreach ($teacherCourse as $tc) {
			$sIDList = DB::table('student_courses')
				->select('student_id')
				->where('course_id', $tc->id)
				->whereNull('deleted_at')
				->get();
			$sList = collect();
			foreach ($sIDList as $id) {
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
	public function getTotalStudentByGender()
	{
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
	public function getTotalStudent()
	{

		$totalStudent = DB::select(
			"SELECT count(id) as totalStudent FROM users
			WHERE role_id= 1;"
		);
		return $totalStudent;
	}

	/**
	 * Get all the user list
	 * @return $userList
	 */
	public function getAllUser()
	{
		$userList = DB::table('users')
						->select('*')
						->whereNull('deleted_at')
						->get();
		return $userList;
	}

	/**
	 * Get all the student list
	 * @return $studentList
	 */
	public function getAllStudent()
	{
		$studentList = DB::table('users')
						->select('*')
						->where('role_id', '1')
						->whereNull('deleted_at')
						->get();
		return $studentList;
	}

	/**
	 * Get all the teacher list
	 * @return $teacherList
	 */
	public function getAllTeacher()
	{
		$teacherList = DB::table('users')
						->select('*')
						->where('role_id', '2')
						->whereNull('deleted_at')
						->get();
		return $teacherList;
	}
}
