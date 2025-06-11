<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Interfaces
use App\Http\Contracts\Auth\LoginRepositoryInterface;
use App\Http\Contracts\Auth\RegisterRepositoryInterface;
use App\Http\Contracts\Apps\MedicalRecordRepositoryInterface;
use App\Http\Contracts\Apps\PatientRepositoryInterface;
use App\Http\Contracts\Auth\RegisterDoctorRepositoryInterface;
use App\Http\Contracts\Apps\SpecializationRepositoryInterface;

// Repository
use App\Http\Repositories\Auth\LoginRepository;
use App\Http\Repositories\Auth\RegisterRepository;
use App\Http\Repositories\Apps\MedicalRecordRepository;
use App\Http\Repositories\Apps\PatientRepository;
use App\Http\Repositories\Apps\SpecializationRepository;
use App\Http\Repositories\Auth\RegisterDoctorRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Auth
        $this->app->bind(RegisterRepositoryInterface::class, RegisterRepository::class);
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
        $this->app->bind(RegisterDoctorRepositoryInterface::class, RegisterDoctorRepository::class);

        // Apps
        $this->app->bind(SpecializationRepositoryInterface::class, SpecializationRepository::class);
        $this->app->bind(MedicalRecordRepositoryInterface::class, MedicalRecordRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
