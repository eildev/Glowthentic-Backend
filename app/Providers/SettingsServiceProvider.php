<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind the Setting model to the service container
        $this->app->singleton('settings', function () {
            return Setting::latest()->first() ?? new Setting(['isMultipleCategory' => 0]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share settings with all views using a view composer
        View::composer('*', function ($view) {
            $setting = app('settings');
            $view->with('setting', $setting);
        });
    }
}
