<?php

namespace App\Providers;

use App\Contracts\Dao\Course\CourseDaoInterface;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Dao\Course\CourseDao;
use App\Dao\User\UserDao;
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
      $this->app->bind(UserDaoInterface::class, UserDao::class,); 
      $this->app->bind(UserServiceInterface::class, UserService::class);   

      $this->app->bind(CourseDaoInterface::class, CourseDao::class,); 
      // $this->app->bind(StudentServiceInterface::class, StudentService::class);
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
