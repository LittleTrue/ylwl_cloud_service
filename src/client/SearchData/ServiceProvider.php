<?php

namespace YlWlCloud\YlWlCloudClient\SearchData;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['search_data'] = function ($app) {
            return new Client($app);
        };
    }
}
