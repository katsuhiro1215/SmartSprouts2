<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        if (request()->is('admin/*')) {
            config(['session.cookie' => config('session.cookie_admin')]);
        }
        if (request()->is('owner/*')) {
            config(['session.cookie' => config('session.cookie_owner')]);
        }

        Validator::extend('zipcode_format', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\d{3}-?\d{4}$/', $value);
        });
    }
}
