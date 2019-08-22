# imi-swoole-tracker

[![Latest Version](https://img.shields.io/packagist/v/imiphp/imi-swoole-tracker.svg)](https://packagist.org/packages/imiphp/imi-swoole-tracker)
[![Php Version](https://img.shields.io/badge/php-%3E=7.1-brightgreen.svg)](https://secure.php.net/)
[![Swoole Version](https://img.shields.io/badge/swoole-%3E=4.3.0-brightgreen.svg)](https://github.com/swoole/swoole-src)
[![IMI License](https://img.shields.io/github/license/imiphp/imi-swoole-tracker.svg)](https://github.com/imiphp/imi-swoole-tracker/blob/master/LICENSE)

## 介绍

在 imi 框架中接入 Swoole Tracker 监控

Swoole Tracker: https://www.swoole-cloud.com/tracker.html

* 企业版集成了Facebook的Xhprof工具，可以生成调用堆栈图和火焰图，亦可生成分层分析表格，方便找到程序瓶颈点进行优化。

* 为解决PHP常驻进程的内存泄漏问题，企业版专门针对PHP的内存泄漏检测工具，方便快速的解决和定位内存持续增长问题。

* Swoole异步/协程模式以及ReactPHP等众多框架最致命的就是阻塞调用，会让并发大大降低，为此我们开发了毫秒级阻塞检测工具，迅速定位导致阻塞的代码。

* 自动抓取FPM、CLI进程数量，统计CPU、内存使用情况。

* 所有工具零部署成本，后台一键开启关闭各种检测，完美支持PHP7。

## Composer

本项目可以使用composer安装，遵循psr-4自动加载规则，在你的 `composer.json` 中加入下面的内容:

```json
{
    "require": {
        "imiphp/imi-swoole-tracker": "~1.0"
    }
}
```

然后执行 `composer update` 安装。

## 基本使用

在项目 `config/config.php` 中配置：

```php
[
    'components'    =>  [
        // 引入本组件
        'SwooleTracker'       =>  'Imi\SwooleTracker',
    ],
]
```

### Http 服务

在服务器的 `config/config.php` 中配置：

```php
[
    'beans'    =>    [
        'HttpDispatcher'    =>    [
            'middlewares'    =>    [
                'SwooleTrackerHttpMiddleware',
            ],
        ],
        'SwooleTrackerHttpMiddleware'   =>  [
            'serviceName'   => 'imi-http-example', // 服务名
            'serverIp'      => null, // 服务器 IP，默认获取当前网卡 IP
            'interface'     => null, // 网卡 interface 名，自动获取当前网卡IP时有效
        ],
    ],
];
```

## 进阶使用

如果请求产生异常，自动上报失败，错误码为异常 `code`。

你也可以在代码中指定是否成功和错误码，例子：

```php
RequestContext::set('imi.tracker.success', false);
RequestContext::set('imi.tracker.code', 19260817);
```

## 免费技术支持

QQ群：17916227 [![点击加群](https://pub.idqqimg.com/wpa/images/group.png "点击加群")](https://jq.qq.com/?_wv=1027&k=5wXf4Zq)，如有问题会有人解答和修复。

## 运行环境

- [PHP](https://php.net/) >= 7.1
- [Composer](https://getcomposer.org/)
- [Swoole](https://www.swoole.com/) >= 4.3.0

## 版权信息

`imi-swoole-tracker` 遵循 MIT 开源协议发布，并提供免费使用。

## 捐赠

<img src="https://raw.githubusercontent.com/imiphp/imi-swoole-tracker/master/res/pay.png"/>

开源不求盈利，多少都是心意，生活不易，随缘随缘……
