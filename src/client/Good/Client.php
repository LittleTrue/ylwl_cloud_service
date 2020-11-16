<?php

namespace YlWlCloud\YlWlCloudClient\Good;

use GuzzleHttp\RequestOptions;
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

    /**
     * @var Application
     */
    protected $authAuto;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->credentialValidate = $app['credential'];
        $this->authAuto           = $app['auth_auto'];
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
                'goods' => 'require',
            ]
        );

        //验证平台代码和电商代码
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置' . $this->credentialValidate->getError());
        }

        $infos['Authorization'] = 'Bearer ' . $this->authAuto->token();

        $storeId            = $this->getStoreId($infos['Authorization']);
        $infos['storeUuid'] = $storeId;

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
            ]
        );

        //验证平台代码和电商代码
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置' . $this->credentialValidate->getError());
        }

        $infos['Authorization'] = 'Bearer ' . $this->authAuto->token();

        $storeId            = $this->getStoreId($infos['Authorization']);
        $infos['storeUuid'] = $storeId;

        $this->setParams($infos);

        return $this->httpPostJson('V2/good/brush');
    }

    /**
     * 获取门店信息.
     */
    private function getStoreId($authorization)
    {
        $store = $this->request(
            'POST',
            'V2/pub/store/query',
            [
                RequestOptions::HEADERS => [
                    'Content-Type'  => 'application/json',
                    'timestamp'     => time(),
                    'Authorization' => $authorization,
                ],
            ]
        );

        return $store['body'][0]['uuid'];
    }
}
