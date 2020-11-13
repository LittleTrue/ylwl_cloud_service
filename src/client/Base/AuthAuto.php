<?php

namespace YlWlCloud\YlWlCloudClient\Base;

use GuzzleHttp\RequestOptions;
use YlWlCloud\YlWlCloudClient\Application;

/**
 * 身份验证.
 */
class AuthAuto
{
    use MakesHttpRequests;

    /**
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get token.
     *
     * @throws ClientError
     */
    public function token()
    {
        if ($value = $this->app['cache']->get($this->cacheKey())) {
            return $value;
        }

        $result = $this->request(
            'POST',
            'V1/Login',
            [
                RequestOptions::JSON    => $this->credentials(),
                RequestOptions::HEADERS => [
                    'Content-Type' => 'application/json',
                    'timestamp'    => time(),
                ],
            ]
        );

        $this->setToken($token = $result['body']['token'], 7000);
        return $token;
    }

    /**
     * Set token.
     *
     * @param null $ttl
     */
    public function setToken($token, $ttl = null)
    {
        $this->app['cache']->set($this->cacheKey(), $token, $ttl);

        return $this;
    }

    /**
     * Get credentials.
     */
    protected function credentials()
    {
        return [
            'username' => $this->app['config']->get('username'),
            'password' => $this->app['config']->get('password'),
        ];
    }

    /**
     * Get cachekey.
     */
    protected function cacheKey()
    {
        return 'YlWl.Token.' . md5(json_encode($this->credentials()));
    }
}
