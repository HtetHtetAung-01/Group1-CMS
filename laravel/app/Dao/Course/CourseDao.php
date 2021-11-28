<?php

namespace App\Dao\Course;

use App\Contracts\Dao\Course\CourseDaoInterface;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseDao implements CourseDaoInterface
{
  /**
   * get the enrolled courses of user
   * @param $id, $role
   * @return $enrolledCourse
   */
  public function getEnrolledCourse($id, $role)
  {
    if($role == 'Student') {
      $enrolledCourseID = DB::table('student_courses')
                  ->select('course_id', 'is_completed')
                  ->where('student_id', $id)
                  ->whereNull('deleted_at')
                  ->get();
    }
    
    elseif($role == 'Teacher'){
      $enrolledCourseID = DB::table('teacher_courses')
                  ->select('course_id')
                  ->where('teacher_id', $id)
                  ->whereNull('deleted_at')
                  ->get();
    }

    $enrolledCourse = collect();
    foreach($enrolledCourseID as $courseID) {
      $course = DB::table('courses')
                  ->select('*')
                  ->where('id', $courseID->course_id)
                  ->whereNull('deleted_at')
                  ->first();

      $enrolledCourse->push($course);
    }
    return $enrolledCourse;
    
  }

  /**
   * get the required courses for $course_id
   * @param $course_id
   * @return $requiredCourses
   */
  public function getRequiredCourseID($course_id)
  {
    $requiredCourseID = DB::table('courses')
              ->select('required_courses')
              ->where('id', $course_id)
              ->whereNull('deleted_at')
              ->get();

    return $requiredCourseID;          
  }

  /**
   * get the required courses list
   * @param $requiredCourses
   * @return $requiredCourseList
   */
  public function getRequiredCourseList($requiredCourses)
  {
    $requiredCourseList = collect();
    foreach($requiredCourses as $required) {
      $course = DB::table('courses')
                  ->select('id','title')
                  ->where('id', $required)
                  ->whereNull('deleted_at')
                  ->get();

      if(count($course) > 0) {
        $requiredCourseList->push($course[0]);
      }                 
    }
    return $requiredCourseList;
  }

  /**
   * get all the courses
   * @return $courseList
   */
  public function getAllCourseList()
  {
    $courseList = DB::table('courses')
                      ->select('*')
                      ->whereNull('deleted_at')
                      ->get();

    return $courseList;                  
  }

  /**
   * add new course
   * @param $request
   * @return $course
   */
  public function addNewCourse($request)
  {
    return DB::transaction(function () use ($request) {
      $course = new Course;
      $course->title = $request->title;
      $course->category = $request->category;
      $course->description = $request->description;
      $course->required_courses = $request->requiredCourses;
      $course->save();
      return $course;
    });
  }

  /**
   * search course
   * @return $courseList
   */
  public function getSearchCourseList()
  {
    $searchText = $_GET['search-text'];
    info("search text = $searchText");

    if($searchText != "") {
      $courseList = Course::where('title', 'LIKE', '%'.$searchText.'%')
                            ->whereNull('deleted_at')
                            ->get();
    }
    info("search course list");
    info($courseList);
    return $courseList;
  }

  // DB::table('courses')
  //                     ->select('*')
  //                     ->where('title', 'LIKE', '%'.$searchText.'%')
  //                     ->get();

}