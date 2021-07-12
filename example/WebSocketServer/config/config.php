<?php

return [
    // 项目根命名空间
    'namespace'    => 'Imi\SwooleTracker\Example\WebSocketServer',

    // 配置文件
    'configs'    => [
        'beans'        => __DIR__ . '/beans.php',
    ],

    // 扫描目录
    'beanScan'    => [
        'Imi\SwooleTracker\Example\WebSocketServer\Listener',
    ],

    // 组件命名空间
    'components'    => [
        'SwooleTracker'       => 'Imi\SwooleTracker',
    ],

    // 主服务器配置
    'mainServer'    => [
        'namespace'    => 'Imi\SwooleTracker\Example\WebSocketServer\MainServer',
        'type'         => Imi\Server\Type::WEBSOCKET,
        'host'         => '127.0.0.1',
        'port'         => 13002,
        'configs'      => [
            'worker_num'    => 1,
        ],
    ],

    // 子服务器（端口监听）配置
    'subServers'        => [
    ],

    // 连接池配置
    'pools'    => [
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
                    'port'      => imiGetEnv('REDIS_SERVER_PORT', 6379),
                    'password'  => imiGetEnv('REDIS_SERVER_PASSWORD'),
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
                    'port'      => imiGetEnv('REDIS_SERVER_PORT', 6379),
                    'password'  => imiGetEnv('REDIS_SERVER_PASSWORD'),
                ],
            ],
        ],
    ],

    // redis 配置
    'redis' => [
        // 数默认连接池名
        'defaultPool'   => 'redis',
    ],

    // 内存表配置
    'memoryTable'   => [
        'connectContext'    => [
            'class'  => \Imi\Server\ConnectContext\StoreHandler\MemoryTable\ConnectContextOption::class,
            'lockId' => 'atomic',
        ],
    ],

    // atmoic 配置
    'atomics'    => [
        'atomic1'   => 1,
    ],

    // 锁配置
    'lock'  => [
        'default' => 'atomic',
        'list'    => [
            'atomic' => [
                'class'     => 'AtomicLock',
                'options'   => [
                    'atomicName'    => 'atomic1',
                ],
            ],
        ],
    ],
];
