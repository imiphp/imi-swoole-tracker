<?php
namespace Imi\SwooleTracker\Example\TCPServer\TCPServer\Controller;

use Imi\Server\Route\Annotation\Tcp\TcpRoute;
use Imi\Server\Route\Annotation\Tcp\TcpAction;
use Imi\Server\Route\Annotation\Tcp\TcpController;

/**
 * 数据收发测试
 * @TcpController
 */
class IndexController extends \Imi\Controller\TcpController
{
    /**
     * 发送消息
     *
     * @TcpAction
     * @TcpRoute({"action"="send"})
     * @param 
     * @return void
     */
    public function send($data)
    {
        $clientInfo = $this->server->getSwooleServer()->getClientInfo($this->data->getFd());
        $message = '[' . ($clientInfo['remote_ip'] ?? '') . ':' . ($clientInfo['remote_port'] ?? '') . ']: ' . $data->message;
        var_dump($message);
        return [
            'success'   =>  true,
            'data'      =>  $message,
        ];
    }

}