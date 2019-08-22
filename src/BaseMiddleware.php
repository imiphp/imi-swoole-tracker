<?php
namespace Imi\SwooleTracker;

abstract class BaseMiddleware
{
    /**
     * 服务名
     *
     * @var string
     */
    protected $serviceName = 'imi';

    /**
     * 服务器 IP，默认获取当前网卡 IP
     *
     * @var string
     */
    protected $serverIp;

    /**
     * 网卡 interface 名
     * 自动获取当前网卡IP时有效
     *
     * @var string
     */
    protected $interface;

    /**
     * 当成功时上报的默认code
     *
     * @var integer
     */
    protected $successCode = 0;

    /**
     * 当发生异常时上报的默认code
     *
     * @var integer
     */
    protected $exceptionCode = 500;

    public function __init()
    {
        if(null === $this->serverIp)
        {
            $this->serverIp = $this->getLocalIP($this->interface);
        }
    }

    /**
     * 获取本机IP
     *
     * @return string
     */
    protected function getLocalIP()
    {
        $list = \swoole_get_local_ip();
        if($this->interface)
        {
            $ip = $list[$this->interface] ?? null;
        }
        if(!$this->serverIp)
        {
            $ip = current($list);
        }
        return $ip;
    }

}
