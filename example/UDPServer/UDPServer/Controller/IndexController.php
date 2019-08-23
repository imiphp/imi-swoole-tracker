<?php
namespace Imi\SwooleTracker\Example\UDPServer\UDPServer\Controller;

use Imi\ConnectContext;
use Imi\Server\Route\Annotation\Udp\UdpRoute;
use Imi\Server\Route\Annotation\Udp\UdpAction;
use Imi\Server\Route\Annotation\Udp\UdpController;

/**
 * 数据收发测试
 * @UdpController
 */
class IndexController extends \Imi\Controller\UdpController
{
    /**
     * 登录
     * 
     * @UdpAction
     * @UdpRoute({"action"="hello"})
     * @return void
     */
    public function hello()
    {
        return [
            'time'    =>    date($this->data->getFormatData()->format),
        ];
    }

}