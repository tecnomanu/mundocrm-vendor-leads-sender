<?php
namespace MundoCRM\Leads;

use Illuminate\Support\ServiceProvider;

class SenderProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
        // $this->loadMigrationsFrom(__DIR__.'/migrations');
        // $this->loadViewsFrom(__DIR__.'/views', 'todolist');
        // $this->publishes([
        //     __DIR__.'/views' => base_path('resources/views/wisdmlabs/todolist'),
        // ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->make('wisdmLabs\todolist\TodolistController');
    }
}