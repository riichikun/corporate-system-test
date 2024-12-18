<?php

namespace App\Providers;

use App\Models\User;
use App\Services\UserRoleService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, function () {
            return new UserService(new User);
        });
        $this->app->bind(UserRoleService::class, function () {
            return new UserRoleService(new User);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
