<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        //
        Schema::defaultStringLength(191);

    Paginator::useBootstrap();

    //  لو عندي تصميم خاص ل pagination انا عاملو
    // هيتطبق علي الابلكيشن كله
    // Paginator::defaultView('folderName');

    }
}
