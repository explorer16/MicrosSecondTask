<?php

namespace App\Providers;

use App\Repositories\Eloquent\SupplierRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
