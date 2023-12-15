<?php

namespace App\Providers;

use App\Interfaces\LoginInterface;
use App\Interfaces\PostInterface;
use App\Interfaces\RegisterInterface;
use App\Interfaces\UserInterface;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $this->app->bind(LoginInterface::class, LoginService::class);
        $this->app->bind(RegisterInterface::class, RegisterService::class);
        $this->app->bind(UserInterface::class, UserService::class);
        $this->app->bind(PostInterface::class, PostService::class);
    }
}
