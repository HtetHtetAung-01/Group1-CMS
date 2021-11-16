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

        // Business logic registration
        $this->app->bind('App\Contracts\Services\Assignment\AssignmentServiceInterface', 'App\Services\Assignment\AssignmentService');
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
