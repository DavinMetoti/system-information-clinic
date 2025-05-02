<?php

namespace App\Providers;

use App\Http\Contracts\Apps\CategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

// Interfaces
use App\Http\Contracts\Auth\RegisterRepositoryInterface;
use App\Http\Contracts\Auth\LoginRepositoryInterface;
use App\Http\Contracts\Apps\SupplierRepositoryInterface;
use App\Http\Repositories\Apps\CategoryRepository;
// Repository
use App\Http\Repositories\Auth\RegisterRepository;
use App\Http\Repositories\Apps\SupplierRepository;
use App\Http\Repositories\Auth\LoginRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Apps
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        // Auth
        $this->app->bind(RegisterRepositoryInterface::class, RegisterRepository::class);
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
