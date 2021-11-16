<?php

namespace App\Providers;

use App\Contracts\Dao\Course\CourseDaoInterface;
use App\Contracts\Dao\Students\StudentDaoInterface;
use App\Contracts\Dao\Teachers\TeacherDaoInterface;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\Students\StudentServiceInterface;
use App\Contracts\Services\Teachers\TeacherServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Dao\Course\CourseDao;
use App\Dao\Students\StudentDao;
use App\Dao\Teachers\TeacherDao;
use App\Dao\User\UserDao;
use App\Services\Students\StudentService;
use App\Services\Teachers\TeacherService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Dao Registration
        $this->app->bind('App\Contracts\Dao\Assignment\AssignmentDaoInterface', 'App\Dao\Assignment\AssignmentDao');
        $this->app->bind('App\Contracts\Dao\Comment\CommentDaoInterface', 'App\Dao\Comment\CommentDao');
        $this->app->bind('App\Contracts\Dao\StudentAssignment\StudentAssignmentDaoInterface', 'App\Dao\StudentAssignment\StudentAssignmentDao');
        $this->app->bind('App\Contracts\Dao\StudentCourse\StudentCourseDaoInterface', 'App\Dao\StudentCourse\StudentCourseDao');
        $this->app->bind('App\Contracts\Dao\TeacherCourse\TeacherCourseDaoInterface', 'App\Dao\TeacherCourse\TeacherCourseDao');

        // Business logic registration
        $this->app->bind('App\Contracts\Services\Student\StudentServiceInterface', 'App\Services\Student\StudentService');
        $this->app->bind('App\Contracts\Services\Teacher\TeacherServiceInterface', 'App\Services\Teacher\TeacherService');

        $this->app->bind(TeacherDaoInterface::class, TeacherDao::class);
        $this->app->bind(TeacherServiceInterface::class, TeacherService::class);

        $this->app->bind(StudentDaoInterface::class, StudentDao::class,);
        $this->app->bind(StudentServiceInterface::class, StudentService::class);

        $this->app->bind(UserDaoInterface::class, UserDao::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(CourseDaoInterface::class, CourseDao::class);
    }
}
