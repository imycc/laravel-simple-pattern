<?php

namespace LaravelSimpleRepo\Provider;


use Illuminate\Support\ServiceProvider;

class LapServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // publish install files
        $this->publishes([__DIR__ . '/../config/lap.php' => config_path('lsr.php')], 'install'); // config
        $this->publishes([__DIR__ . '/../resources/stubs/controllers/BackendController.stub' => app_path('Http/Controllers/Admin/BackendController.php')], 'install'); // backend controller

        // publish config
        $this->publishes([__DIR__ . '/../config/lap.php' => config_path('lsr.php')], 'config');

        // publish backend controller
        $this->publishes([__DIR__ . '/../resources/stubs/controllers/BackendController.stub' => app_path('Http/Controllers/Admin/BackendController.php')], 'backend_controller');

        // Repo commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\MakeBinding::class,
                Commands\MakeRepo::class,
                Commands\MakeRepoInterface::class
            ]);
        }

        // load routes
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    public function register()
    {
        // merge config
        $this->mergeConfigFrom(__DIR__ . '/../config/lap.php', 'lap');
    }

}