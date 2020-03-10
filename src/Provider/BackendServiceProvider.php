<?php

namespace LaravelSimpleRepo\Provider;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            'App\Repositories\DmRepositoryInterface',
            'App\Repositories\DmRepository'
        );
    }
}