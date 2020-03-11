<?php

namespace LaravelSimpleRepo\Provider;


use Illuminate\Support\ServiceProvider;

class LapServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // publish install files
        $this->publishes([__DIR__ . '/../config/lsr.php' => config_path('lsr.php')], 'install'); // config
        $this->publishes([__DIR__ . '/../Provider/BackendServiceProvider.php' => app_path('Providers/BackendServiceProvider.php')], 'install'); // backend controller

        // publish config
        $this->publishes([__DIR__ . '/../config/lsr.php' => config_path('lsr.php')], 'config');

        // Repo commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\MakeBinding::class,
                Commands\MakeRepo::class,
                Commands\MakeRepoInterface::class
            ]);
        }
    }

    public function register()
    {
        // merge config
        $this->mergeConfigFrom(__DIR__ . '/../config/lsr.php', 'lsr');
    }

}