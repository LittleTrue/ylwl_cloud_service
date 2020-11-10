<?php

namespace YlWlCloud\YlWlCloudClient\Good;

use YlWlCloud\YlWlCloudClient\Application;
use YlWlCloud\YlWlCloudClient\Base\BaseClient;
use YlWlCloud\YlWlCloudClient\Base\Exceptions\ClientError;

/**
 * 商品API客户端.
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
     * 新增商品.
     *
     * @throws ClientError
     */
    public function addGood(array $infos)
    {
        //使用Credential验证参数
        $this->credentialValidate->setRule(
            [
                'goods'     => 'require',
                'storeUuid' => 'require',
            ]
        );

        //验证平台代码和电商代码
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置' . $this->credentialValidate->getError());
        }

        $this->setParams($infos);

        return $this->httpPostJson('V2/good');
    }

    /**
     * 单个商品推送
     */
    public function brushGood(array $infos)
    {
        //使用Credential验证参数
        $this->credentialValidate->setRule(
            [
                'information' => 'require',
                'storeUuid'   => 'require',
            ]
        );

        //验证平台代码和电商代码
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置' . $this->credentialValidate->getError());
        }

        $this->setParams($infos);

        return $this->httpPostJson('V2/good/brush');
    }
}
