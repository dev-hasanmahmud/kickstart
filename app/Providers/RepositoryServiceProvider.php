<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\{
    UserRepositoryInterface,
    RoleRepositoryInterface,
    PermissionRepositoryInterface,
    ModuleRepositoryInterface,
    SubModuleRepositoryInterface,
};
use App\Repositories\Eloquent\{
    UserRepository,
    RoleRepository,
    PermissionRepository,
    ModuleRepository,
    SubModuleRepository,
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(ModuleRepositoryInterface::class, ModuleRepository::class);
        $this->app->bind(SubModuleRepositoryInterface::class, SubModuleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
