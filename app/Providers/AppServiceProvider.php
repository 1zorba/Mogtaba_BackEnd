<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // تأكد من وجود هذا السطر في الأعلى

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
        // هذا هو المكان الصحيح للسطر لضمان توافق الجداول مع MySQL السحابي
        Schema::defaultStringLength(191);
    }
}
