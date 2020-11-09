<?php

namespace YlWlCloud\YlWlCloudClient\Login;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['login'] = function ($app) {
            return new Client($app);
        };
    }
}
