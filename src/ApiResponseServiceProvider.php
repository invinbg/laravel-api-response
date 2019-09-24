<?php

namespace InviNBG\ApiResponse;

use Illuminate\Support\ServiceProvider;
use InviNBG\ApiResponse\ApiResponse as Response;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
    }
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('apiResponse', function ($laravelApp) {
            return new Response(new \Illuminate\Http\Response());
        });
    }
}