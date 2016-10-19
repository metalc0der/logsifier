<?php 

namespace Metalcoder\Logsifier\Facades;

use Illuminate\Support\Facades\Facade;

class Logsifier extends Facade {
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'MetalcoderLogsifierController'; // the IoC binding.
    }
}