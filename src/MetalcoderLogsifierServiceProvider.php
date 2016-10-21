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
        
        $this->publishes([__DIR__.'/Config/logsifier.php' => config_path('logsifier.php'),], 'config');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->singleton('metalcoder.logsifier', function($app)
        {
            
            return new Http\Controllers\MetalcoderLogsifierController();

        });

        // Config
        $this->mergeConfigFrom( __DIR__.'/Config/logsifier.php', 'logsifier');

    }
}
