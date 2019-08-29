<?php
namespace Imi\SwooleTracker\UDP\Middleware;

use RuntimeException;
use Imi\RequestContext;
use Imi\Bean\Annotation\Bean;
use Imi\SwooleTracker\BaseMiddleware;
use Imi\Server\UdpServer\IPacketHandler;
use Imi\Server\UdpServer\Message\IPacketData;
use Imi\Server\UdpServer\Middleware\IMiddleware;

/**
 * @Bean("SwooleTrackerUDPMiddleware")
 */
class SwooleTrackerMiddleware extends BaseMiddleware implements IMiddleware
{
    /**
     * 获取当前调用方法名称回调
     *
     * @var callable
     */
    protected $nameHandler;

    public function __init()
    {
        if(null === $this->nameHandler)
        {
            throw new RuntimeException(sprintf('SwooleTrackerTCPMiddleware must be set beans: "nameHandler"'));
        }
        parent::__init();
    }

    public function process(IPacketData $data, IPacketHandler $handler)
    {
        $funcName = ($this->nameHandler)($data);
        $tick = \SwooleTracker\Stats::beforeExecRpc($funcName, $this->serviceName, $this->serverIp);
        try {
            $success = $code = null;
            $result = $handler->handle($data);
            return $result;
        } catch(\Throwable $th) {
            $success = false;
            $code = $this->exceptionCode;
            throw $th;
        } finally {
            if($tick)
            {
                if(null === $success)
                {
                    $success = RequestContext::get('imi.tracker.success');
                }
                if(null === $success)
                {
                    $success = true;
                }
                if(null === $code)
                {
                    $code = RequestContext::get('imi.tracker.code');
                }
                if(null === $code)
                {
                    $code = $success ? $this->successCode : $this->exceptionCode;
                }
                \SwooleTracker\Stats::afterExecRpc($tick, $success, $code);
            }
        }
    }

}
