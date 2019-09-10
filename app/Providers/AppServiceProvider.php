<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RoleService;
use App\Services\UserService;
use App\Repositories\RoleRepo;
use App\Repositories\UserRepo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register RoleService
        $this->app->bind(RoleService::class, function () {
            return new RoleService(new RoleRepo);
        });

                // Register RoleService
        $this->app->bind(UserService::class, function () {
            return new UserService(new UserRepo);
        });
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
