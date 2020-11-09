<?php

namespace YlWlCloud\YlWlCloudClient\Good;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['good'] = function ($app) {
            return new Client($app);
        };
    }
}
