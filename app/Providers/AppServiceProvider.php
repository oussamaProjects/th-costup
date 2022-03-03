<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('email_domain', function ($attribute, $value, $parameters, $validator) {
            $allowedEmailDomains = ['tawzerholding.com', 'geniworks.com', 'vandyser.com', 'vigi-protect.com', 'vigipros.com', 'technicordes.com','geniloyds.com','clickclack360.com','alwassite.com'];
            return in_array(explode('@', $parameters[0])[1], $allowedEmailDomains);
        });
    }
}
