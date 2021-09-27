<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Paginator::useBootstrap();

        $this->publishConfig();
        $this->publishSchema();

        $this->mergeConfig();
    }

    protected function publishConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/lighthouse-sanctum.php' => config_path('lighthouse-sanctum.php'),
        ], 'lighthouse-sanctum');
    }

    protected function publishSchema(): void
    {
        $this->publishes([
            __DIR__ . '/../../graphql/sanctum.graphql' => base_path('graphql/sanctum.graphql'),
        ], 'lighthouse-sanctum');
    }

    protected function mergeConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/lighthouse-sanctum.php',
            'lighthouse-sanctum',
        );
    }
}
