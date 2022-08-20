<?php

namespace App\Providers;

use App\Support\Storage\SessionStorage;
use App\Support\Storage\Contracts\StorageInterface;
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
        $this->app->bind(StorageInterface::class,function($app){
            return new SessionStorage('cart');
        });
    }
}
