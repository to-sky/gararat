<?php

namespace App\Providers;

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
        if(!isset($_COOKIE['userKey']) || $_COOKIE['userKey'] === NULL) {
            setcookie('userKey', hash('sha256', uniqid()), time()+60*60*24*30);
        }
        //view()->share($data);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
