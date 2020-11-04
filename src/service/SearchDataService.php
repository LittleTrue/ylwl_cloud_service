<?php

namespace YlWlCloud\YlWlCloudService;

use YlWlCloud\YlWlCloudClient\Application;
use YlWlCloud\YlWlCloudClient\Base\Exceptions\ClientError;

/**
 * 订单导入API服务.
 */
class SearchDataService
{
    /**
     * @var SearchDataClient
     */
    private $_searchDataClient;

    public function __construct(Application $app)
    {
        $this->_searchDataClient = $app['search_data'];
    }

    /**
     * 订单查询.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function searchOrder(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_searchDataClient->searchOrder($infos);
    }

    /**
     * 商品货号库查询.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function searchGoods(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_searchDataClient->searchGoods($infos);
    }
}
