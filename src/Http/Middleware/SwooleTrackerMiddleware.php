<?php
namespace Imi\SwooleTracker\Http\Middleware;

use Imi\Bean\Annotation\Bean;
use Imi\RequestContext;
use Imi\SwooleTracker\BaseMiddleware;
use Imi\Util\Http\Consts\StatusCode;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * @Bean("SwooleTrackerHttpMiddleware")
 */
class SwooleTrackerMiddleware extends BaseMiddleware implements MiddlewareInterface
{
    /**
     * 成功的 Http 状态码
     *
     * @var int
     */
    protected $successStatusCode = StatusCode::OK;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $tick = \StatsCenter::beforeExecRpc($request->getUri()->getPath(), $this->serviceName, $this->serverIp);
        try {
            $success = $code = null;
            $response = $handler->handle($request);
            return $response;
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
                    $success = $this->successStatusCode === $response->getStatusCode();
                }
                if(null === $code)
                {
                    $code = RequestContext::get('imi.tracker.code');
                }
                if(null === $code)
                {
                    $code = $success ? $this->successCode : $response->getStatusCode();
                }
                \StatsCenter::afterExecRpc($tick, $success, $code);
            }
        }
    }

}
