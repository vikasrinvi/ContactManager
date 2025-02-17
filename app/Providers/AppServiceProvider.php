<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ContactRepositoryInterface;
use App\Repositories\ContactRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
