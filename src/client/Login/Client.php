<?php

namespace YlWlCloud\YlWlCloudClient\Login;

use YlWlCloud\YlWlCloudClient\Application;
use YlWlCloud\YlWlCloudClient\Base\BaseClient;
use YlWlCloud\YlWlCloudClient\Base\Exceptions\ClientError;

/**
 * 登录API客户端.
 */
class Client extends BaseClient
{
    /**
     * @var Application
     */
    protected $credentialValidate;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->credentialValidate = $app['credential'];
    }

    /**
     * 登录.
     *
     * @throws ClientError
     */
    public function login(array $infos)
    {
        //使用Credential验证参数
        $this->credentialValidate->setRule(
            [
                'username' => 'require',
                'password' => 'require',
            ]
        );
        //验证平台代码和电商代码
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置' . $this->credentialValidate->getError());
        }

        $this->setParams($infos);

        return $this->httpPostJson('V1/Login');
    }
}
