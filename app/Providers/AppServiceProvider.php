<?php

namespace App\Providers;

use App\Repositories\EloquentProjectRepository;
use App\Repositories\EloquentUserRepository;
use Core\Project\ProjectRepository;
use Core\User\UserRepository;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(ProjectRepository::class, EloquentProjectRepository::class);
    }
}
