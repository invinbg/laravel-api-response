<?php

namespace InviNBG\ApiResponse;

use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(MakeCriteriaCommand::class);
    }
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
    }
}