<?php

namespace YlWlCloud\YlWlCloudService;

use YlWlCloud\YlWlCloudClient\Application;
use YlWlCloud\YlWlCloudClient\Base\Exceptions\ClientError;

/**
 * 订单导入API服务.
 */
class OrderImportService
{
    /**
     * @var OrderImportClient
     */
    private $_orderImportClient;

    public function __construct(Application $app)
    {
        $this->_orderImportClient = $app['order_import'];
    }

    /**
     * 导入订单.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function importOrder(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_orderImportClient->importOrder($infos);
    }
}
