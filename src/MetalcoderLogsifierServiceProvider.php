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
        
        //Publish migrations
       // $this->publishes([__DIR__ . '/migrations/2016_05_17_183336_create_pd_log_table.php' => base_path('database/migrations/2016_05_17_183336_create_pd_log_table.php')]);

        $this->loadMigrationsFrom(__DIR__.'/migrations/');
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        


    }
}
