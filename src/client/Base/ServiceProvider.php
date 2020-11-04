<?php

namespace YlWlCloud\YlWlCloudClient\Base;

use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\RequestOptions;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        //注册通讯服务
        $app['http_client'] = function ($app) {
            return new GuzzleHttp([
                RequestOptions::TIMEOUT => 60,
            ]);
        };

        //注册验证器
        $app['credential'] = function ($app) {
            return new Credential($app);
        };
    }
}
