<?php

use Imi\Server\UdpServer\Message\IPacketData;

return [
    'configs'    => [
    ],
    // bean扫描目录
    'beanScan'    => [
        'Imi\SwooleTracker\Example\UDPServer\UDPServer\Controller',
    ],
    'beans'    => [
        'UdpDispatcher'    => [
            'middlewares'    => [
                \Imi\Server\UdpServer\Middleware\RouteMiddleware::class,
                'SwooleTrackerUDPMiddleware',
            ],
        ],
        'SwooleTrackerUDPMiddleware'  => [
            'serviceName'       => 'imi-udp-example', // 服务名
            // 'serverIp'          => null, // 服务器 IP，默认获取当前网卡 IP
            // 'interface'         => null, // 网卡 interface 名，自动获取当前网卡IP时有效
            // 'successCode'       =>  500, // 当成功时上报的默认code
            // 'exceptionCode'     =>  500, // 当发生异常时上报的默认code
            'nameHandler'       => function (IPacketData $data) {
                return $data->getFormatData()->action ?? 'unknown';
            },
        ],
    ],
];
