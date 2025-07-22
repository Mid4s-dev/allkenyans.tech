<?php

namespace App\Providers;

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
        // Auto-register components in the components directory
        $this->loadViewComponentsAs('', [
            \App\View\Components\Header::class,
            \App\View\Components\Footer::class,
            \App\View\Components\DarkModeToggle::class,
        ]);
    }
}
