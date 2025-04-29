<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Interfaces
use App\Http\Contracts\Auth\RegisterRepositoryInterface;
use App\Http\Contracts\Auth\LoginRepositoryInterface;

// Repository
use App\Http\Repositories\Auth\RegisterRepository;
use App\Http\Repositories\Auth\LoginRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
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
