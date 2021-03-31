<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\OrderRepositoryInterface',
            'App\Repositories\OrderRepository'
        );
    }
}