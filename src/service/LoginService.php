<?php

namespace YlWlCloud\YlWlCloudService;

use YlWlCloud\YlWlCloudClient\Application;
use YlWlCloud\YlWlCloudClient\Base\Exceptions\ClientError;

/**
 * 订单导入API服务.
 */
class LoginService
{
    /**
     * @var LoginClient
     */
    private $_loginClient;

    public function __construct(Application $app)
    {
        $this->_loginClient = $app['login'];
    }

    /**
     * 登录.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function login(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_loginClient->login($infos);
    }
}
