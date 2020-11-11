<?php

require_once __DIR__ . '/vendor/autoload.php';

use YlWlCloud\YlWlCloudClient\Application;
use YlWlCloud\YlWlCloudService\GoodService;
use YlWlCloud\YlWlCloudService\LoginService;

// $ioc_con_app = new Application([
//     'BaseUri'  => 'http://asia.esl.minew.com:9191/',
// ]);

// //登录服务-----
// $loginSrv = new LoginService($ioc_con_app);

// $array = [
//     "username" => "Test003",
//     "password" => "MSYC003"
// ];

// print_r(json_encode($loginSrv->login($array)));die();

$ioc_con_app = new Application([
    'BaseUri'       => 'http://asia.esl.minew.com:9191/',
    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDUxNDc0MzQsInN1YiI6IlRlc3QwMDMiLCJ1c2VySWQiOiJmNDMxZDE5YjBjNTUxMWViYWZmZDAyNDJjMGE4YjAwMyIsInBhc3N3b3JkIjoiNTQyMzM1NDUwMzU3YTFhNmEzNTlkOTBhNTc2NWFhYmMifQ.GgJuTN3_KdLH9YysmVL8-56KBatAnJcmH8HpBjFiZzQ',
]);
//新增商品服务-----
$goodSrv = new GoodService($ioc_con_app);
// $array = [
//     'goods' => [
//         [
//             'barcode' => '69019397
//             21247',
//             'qrcode'  => 'http://minew.com',
//             'label1'  => '6901939721247',
//             'label2'  => 'http://minew.com',
//             'label3'  => '6901939721247',
//             'label4'  => '芬达 2.5L/瓶',
//             'label5'  => '芬达',
//             'label6'  => '5.80',
//             'label7'  => '可口',
//             'label8'  => '2.5L/瓶',
//             'label9'  => 'A',
//             'label10' => '瓶',
//             'label11' => '中国',
//             'label12' => '可口',
//         ],
//         [
//             'barcode' => '6901939721247',
//             'qrcode'  => 'http://minew.com',
//             'label1'  => '6901939721247',
//             'label2'  => 'http://minew.com',
//             'label3'  => '6901939721247',
//             'label4'  => '芬达 2.5L/瓶',
//             'label5'  => '芬达',
//             'label6'  => '5.80',
//             'label7'  => '可口',
//             'label8'  => '2.5L/瓶',
//             'label9'  => 'A',
//             'label10' => '瓶',
//             'label11' => '中国',
//             'label12' => '可口',
//         ],
//     ],
//     'storeUuid' => '3',
// ];

// print_r(json_encode($goodSrv->addGood($array), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)); die();

//单个商品推送服务-----
$data = [
    'information' => [
        'barcode' => '6901939721247',
        'qrcode'  => 'http://minew.com',
        'label1'  => '6901939721247',
        'label2'  => 'http://minew.com',
        'label3'  => '6901939721247',
        'label4'  => '芬达 2.5L/瓶',
        'label5'  => '芬达',
        'label6'  => '5.80',
        'label7'  => '炫迈',
        'label8'  => '50.4克',
        'label9'  => 'A',
        'label10' => '深圳云里物里科技股份有限公司',
        'label11' => '中国',
        'label12' => '炫迈',
    ],
    'storeUuid' => '3',
];

print_r(json_encode($goodSrv->brushGood($data), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
die();
