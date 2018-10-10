<?php

namespace App\Providers;

use App\Contracts\CaptchaContract;
use App\Contracts\HttpContract;
use App\Contracts\LoggerContract;
use App\Contracts\ResponseContract;
use App\Services\CaptchaService;
use App\Services\HttpService;
use App\Services\ResponseService;
use App\Supports\Heplers\LoggerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HttpContract::class, HttpService::class);
        $this->app->bind(LoggerContract::class, LoggerService::class);
        $this->app->bind(CaptchaContract::class, CaptchaService::class);
        $this->app->bind(ResponseContract::class, ResponseService::class);
    }
}
