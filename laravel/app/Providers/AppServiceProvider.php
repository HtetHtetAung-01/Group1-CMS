<?php

namespace App\Providers;

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
