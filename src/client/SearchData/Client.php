<?php

namespace YlWlCloud\YlWlCloudClient\SearchData;

use YlWlCloud\YlWlCloudClient\Application;
use YlWlCloud\YlWlCloudClient\Base\BaseClient;
use YlWlCloud\YlWlCloudClient\Base\Exceptions\ClientError;

/**
 * 订单导入API客户端.
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
     * 订单查询.
     *
     * @throws ClientError
     */
    public function searchOrder(array $infos)
    {
        //使用Credential验证参数
        $this->credentialValidate->setRule(
            [
                'Datas' => 'require',
            ]
        );
        //验证主体配置
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置' . $this->credentialValidate->getError());
        }

        $data = $infos['Datas'];

        $this->credentialValidate->setRule(
            [
                'Entrecordno' => 'require|max:20',
                'OrderNo'     => 'require|max:60',
            ]
        );
        //验证订单查询条件
        foreach ($data as $k => $v) {
            if (!$this->credentialValidate->check($v)) {
                throw new ClientError('订单查询条件' . $this->credentialValidate->getError());
            }
        }

        $this->setParams($infos);

        return $this->httpPostJson('OrderManage/SearchData');
    }

    /**
     * 商品货号库查询.
     */
    public function searchGoods($infos)
    {
        $this->credentialValidate->setRule(
            [
                'Datas' => 'require',
            ]
        );
        //验证主体配置
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置' . $this->credentialValidate->getError());
        }

        $data = $infos['Datas'];

        $this->credentialValidate->setRule(
            [
                'GoodsNo'       => 'max:30',
                'CbeGoodsNo'    => 'max:30',
                'StoreRecordNo' => 'require|max:10',
            ]
        );
        //验证订单查询条件
        foreach ($data as $k => $v) {
            if (!$this->credentialValidate->check($v)) {
                throw new ClientError('订单查询条件' . $this->credentialValidate->getError());
            }
            if (empty($v['GoodsNo']) && empty($v['CbeGoodsNo'])) {
                throw new ClientError('GoodsNo和CbeGoodsNo至少填写一个');
            }
        }

        $this->setParams($infos);

        return $this->httpPostJson('GoodsBase/SearchData');
    }
}
