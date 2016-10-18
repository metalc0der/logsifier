<?php

namespace Metalcoder\Logsifier;

use Illuminate\Support\ServiceProvider;

class MetalcoderLogsifierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        require __DIR__ . '/Http/routes.php';
        $this->publishes([__DIR__ . '/migrations/2016_05_17_183336_create_pd_log_table.php' => base_path('database/migrations/2016_05_17_183336_create_pd_log_table.php.php')]);
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
        include __DIR__.'/Http/routes.php';

    }
}