<?php

namespace YlWlCloud\YlWlCloudService;

use YlWlCloud\YlWlCloudClient\Application;
use YlWlCloud\YlWlCloudClient\Base\Exceptions\ClientError;

/**
 * 订单导入API服务.
 */
class GoodService
{
    /**
     * @var goodClient
     */
    private $_goodClient;

    public function __construct(Application $app)
    {
        $this->_goodClient = $app['good'];
    }

    /**
     * 新增商品.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function addGood(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_goodClient->addGood($infos);
    }

    /**
     * 单个商品推送.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function brushGood(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_goodClient->brushGood($infos);
    }
}
