<?php

declare(strict_types=1);

namespace Imi\SwooleTracker\Example\TCPServer\TCPServer\Controller;

use Imi\Server\Route\Annotation\Tcp\TcpAction;
use Imi\Server\Route\Annotation\Tcp\TcpController;
use Imi\Server\Route\Annotation\Tcp\TcpRoute;

/**
 * 数据收发测试.
 *
 * @TcpController
 */
class IndexController extends \Imi\Controller\TcpController
{
    /**
     * 发送消息.
     *
     * @TcpAction
     *
     * @TcpRoute({"action": "send"})
     *
     * @param mixed $data
     *
     * @return mixed
     */
    public function send($data)
    {
        $address = $this->data->getClientAddress();
        $message = '[' . $address->getAddress() . ':' . $address->getPort() . ']: ' . $data->message;
        var_dump($message);

        return [
            'success'   => true,
            'data'      => $message,
        ];
    }
}
