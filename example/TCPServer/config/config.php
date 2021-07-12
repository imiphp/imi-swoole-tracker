<?php

return [
    // 项目根命名空间
    'namespace'    => 'Imi\SwooleTracker\Example\TCPServer',

    // 配置文件
    'configs'    => [
        'beans'        => __DIR__ . '/beans.php',
    ],

    // 扫描目录
    'beanScan'    => [
        'Imi\SwooleTracker\Example\TCPServer\Listener',
        'Imi\SwooleTracker\Example\TCPServer\Task',
    ],

    // 组件命名空间
    'components'    => [
        'SwooleTracker'       => 'Imi\SwooleTracker',
    ],

    // 主服务器配置
    'mainServer'    => [
        'namespace'    => 'Imi\SwooleTracker\Example\TCPServer\TCPServer',
        'type'         => Imi\Server\Type::TCP_SERVER,
        'host'         => '127.0.0.1',
        'port'         => 8082,
        'configs'      => [
            // 'worker_num'        =>  8,
            // 'task_worker_num'   =>  16,

            // 分包方式

            // 分包方式1-EOF自动分包
            'open_eof_split'    => true, //打开EOF_SPLIT检测
            'package_eof'       => "\r\n", //设置EOF

            // 分包方式2-固定包头
            // 'open_eof_split'        => false,
            // 'open_length_check'     => true,
            // 'package_length_type'   => 'N',
            // 'package_length_offset' => 0,       //第N个字节是包长度的值
            // 'package_body_offset'   => 4,       //第几个字节开始计算长度
            // 'package_max_length'    => 1024 * 1024,  //协议最大长度
        ],
        // EOF自动分包数据处理器
        'dataParser'        => \Imi\SwooleTracker\Example\TCPServer\TCPServer\DataParser\JsonObjectEOFParser::class,
        // 固定包头分包数据处理器
        // 'dataParser'            => \Imi\SwooleTracker\Example\TCPServer\TCPServer\DataParser\JsonObjectFixedParser::class,
    ],

    // 子服务器（端口监听）配置
    'subServers'        => [
        // 'SubServerName'   =>  [
        //     'namespace'    =>    'Imi\SwooleTracker\Example\TCPServer\XXXServer',
        //     'type'        =>    Imi\Server\Type::HTTP,
        //     'host'        =>    '127.0.0.1',
        //     'port'        =>    13005,
        // ]
    ],

    // 连接池配置
    'pools'    => [
        // 主数据库
        // 'maindb'    =>    [
        //     // 同步池子
        //     'sync'    =>    [
        //         'pool'    =>    [
        //             'class'        =>    \Imi\Db\Pool\SyncDbPool::class,
        //             'config'    =>    [
        //                 'maxResources'    =>    10,
        //                 'minResources'    =>    0,
        //             ],
        //         ],
        //         'resource'    =>    [
        //             'host'        => '127.0.0.1',
        //             'port'        => 3306,
        //             'username'    => 'root',
        //             'password'    => 'root',
        //             'database'    => 'database_name',
        //             'charset'     => 'utf8mb4',
        //         ],
        //     ],
        //     // 异步池子，worker进程使用
        //     'async'    =>    [
        //         'pool'    =>    [
        //             'class'        =>    \Imi\Db\Pool\CoroutineDbPool::class,
        //             'config'    =>    [
        //                 'maxResources'    =>    10,
        //                 'minResources'    =>    0,
        //             ],
        //         ],
        //         'resource'    =>    [
        //             'host'        => '127.0.0.1',
        //             'port'        => 3306,
        //             'username'    => 'root',
        //             'password'    => 'root',
        //             'database'    => 'database_name',
        //             'charset'     => 'utf8mb4',
        //         ],
        //     ]
        // ],
        'redis'    => [
            'sync'    => [
                'pool'    => [
                    'class'        => \Imi\Redis\SyncRedisPool::class,
                    'config'       => [
                        'maxResources'    => 10,
                        'minResources'    => 0,
                    ],
                ],
                'resource'    => [
                    'host'      => imiGetEnv('REDIS_SERVER_HOST', '127.0.0.1'),
                    'port'      => 6379,
                    'password'  => null,
                ],
            ],
            'async'    => [
                'pool'    => [
                    'class'        => \Imi\Redis\CoroutineRedisPool::class,
                    'config'       => [
                        'maxResources'    => 10,
                        'minResources'    => 0,
                    ],
                ],
                'resource'    => [
                    'host'      => imiGetEnv('REDIS_SERVER_HOST', '127.0.0.1'),
                    'port'      => 6379,
                    'password'  => null,
                ],
            ],
        ],
    ],

    // 数据库配置
    'db'    => [
        // 数默认连接池名
        'defaultPool'    => 'maindb',
    ],

    // redis 配置
    'redis' => [
        // 数默认连接池名
        'defaultPool'   => 'redis',
    ],

    // 内存表配置
    'memoryTable'   => [
        // 't1'    =>  [
        //     'columns'   =>  [
        //         ['name' => 'name', 'type' => \Swoole\Table::TYPE_STRING, 'size' => 16],
        //         ['name' => 'quantity', 'type' => \Swoole\Table::TYPE_INT],
        //     ],
        //     'lockId'    =>  'atomic',
        // ],
    ],

    // 锁
    'lock'  => [
        'list'  => [
            'redis' => [
                'class'     => 'RedisLock',
                'options'   => [
                    'poolName'  => 'redis',
                ],
            ],
        ],
    ],

    // atmoic 配置
    'atomics'    => [
        // 'atomicLock'   =>  1,
    ],
];
