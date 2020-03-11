<?php

namespace LaravelSimpleRepo;

use Illuminate\Support\ServiceProvider;

class LsrServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // publish install files
        $this->publishes([__DIR__ . '/../config/lsr.php' => config_path('lsr.php')], 'install'); // config
        $this->publishes([__DIR__ . '/Provider/Stubs/RepositoryServiceProvider.stub' => app_path('Providers/RepositoryServiceProvider.php')], 'install'); // backend controller

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
        
    }

}