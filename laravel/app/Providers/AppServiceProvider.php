<?php

namespace App\Providers;

use App\Contracts\Dao\Assignment\AssignmentDaoInterface;
use App\Contracts\Dao\Comment\CommentDaoInterface;
use App\Contracts\Dao\Course\CourseDaoInterface;
use App\Contracts\Dao\PasswordReset\PasswordResetDaoInterface;
use App\Contracts\Dao\StudentAssignment\StudentAssignmentDaoInterface;
use App\Contracts\Dao\StudentCourse\StudentCourseDaoInterface;
use App\Contracts\Dao\TeacherCourse\TeacherCourseDaoInterface;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\Admin\AdminServiceInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Contracts\Services\Assignment\AssignmentServiceInterface;
use App\Contracts\Services\Course\CourseServiceInterface;
use App\Contracts\Services\Student\StudentServiceInterface;
use App\Contracts\Services\Teacher\TeacherServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Dao\Assignment\AssignmentDao;
use App\Dao\Comment\CommentDao;
use App\Dao\Course\CourseDao;
use App\Dao\PasswordReset\PasswordResetDao;
use App\Dao\StudentAssignment\StudentAssignmentDao;
use App\Dao\StudentCourse\StudentCourseDao;
use App\Dao\TeacherCourse\TeacherCourseDao;
use App\Dao\User\UserDao;
use App\Services\Admin\AdminService;
use App\Services\Auth\AuthService;
use App\Services\Assignment\AssignmentService;
use App\Services\Course\CourseService;
use App\Services\Student\StudentService;
use App\Services\Teacher\TeacherService;
use App\Services\User\UserService;
use Carbon\Laravel\ServiceProvider;
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
        $this->app->bind(UserDaoInterface::class, UserDao::class); 
        $this->app->bind(CourseDaoInterface::class, CourseDao::class); 
        $this->app->bind(AssignmentDaoInterface::class, AssignmentDao::class);
        $this->app->bind(CommentDaoInterface::class, CommentDao::class);
        $this->app->bind(StudentAssignmentDaoInterface::class, StudentAssignmentDao::class);
        $this->app->bind(StudentCourseDaoInterface::class, StudentCourseDao::class);
        $this->app->bind(TeacherCourseDaoInterface::class, TeacherCourseDao::class);
        $this->app->bind(PasswordResetDaoInterface::class, PasswordResetDao::class);
        
        // Business logic registration
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(CourseServiceInterface::class, CourseService::class); 
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AssignmentServiceInterface::class, AssignmentService::class);
        $this->app->bind(StudentServiceInterface::class, StudentService::class);
        $this->app->bind(TeacherServiceInterface::class, TeacherService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
