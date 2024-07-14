<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Config;

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
        try {
            foreach (Config::all() as $setting) {
                \Illuminate\Support\Facades\Config::set($setting->key, $setting->value);
            }
        } catch (\Exception $e) {
            // \Log::info("Database connection not established");
        }
    }
}
