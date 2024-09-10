<?php

namespace App\Providers;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Login\UserTypes\EmailUser;
use App\Services\Login\UserTypes\GithubUser;
use App\Services\Login\UserTypes\GoogleUser;
use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GithubUser::class, function ($app) {
            return new GithubUser($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(GoogleUser::class, function ($app) {
            return new GoogleUser($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(EmailUser::class, function ($app) {
            return new EmailUser($app->make(UserRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
