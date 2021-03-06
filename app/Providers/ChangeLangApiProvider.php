<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ChangeLangApiProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if(request()->is('api/*')){

            if(request()->header('Lang') ){
                app()->setLocale(request()->header('Lang'));
            }
        }
    }
}
