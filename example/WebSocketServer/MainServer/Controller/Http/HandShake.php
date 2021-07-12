<?php

namespace Imi\SwooleTracker\Example\WebSocketServer\MainServer\Controller\Http;

use Imi\Controller\HttpController;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\View\Annotation\View;
use Imi\Util\Http\Consts\StatusCode;

/**
 * 手动握手测试，不会触发框架内置的握手处理.
 *
 * @Controller
 * @View(renderType="html")
 */
class HandShake extends HttpController
{
    /**
     * 连接地址：ws://127.0.0.1:8083/testHandShake.
     *
     * @Action
     * @Route("/testHandShake")
     *
     * @return void
     */
    public function index()
    {
        // 手动握手处理

        $secWebSocketKey = $this->request->getHeaderLine('sec-websocket-key');
        if (0 === preg_match('#^[+/0-9A-Za-z]{21}[AQgw]==$#', $secWebSocketKey) || 16 !== \strlen(base64_decode($secWebSocketKey)))
        {
            return;
        }

        $key = base64_encode(sha1($secWebSocketKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));

        $headers = [
            'Upgrade'               => 'websocket',
            'Connection'            => 'Upgrade',
            'Sec-WebSocket-Accept'  => $key,
            'Sec-WebSocket-Version' => '13',
        ];

        if ($this->request->hasHeader('Sec-WebSocket-Protocol'))
        {
            $headers['Sec-WebSocket-Protocol'] = $this->request->getHeaderLine('Sec-WebSocket-Protocol');
        }

        foreach ($headers as $key => $val)
        {
            $this->response = $this->response->withHeader($key, $val);
        }

        $this->response = $this->response->withStatus(StatusCode::SWITCHING_PROTOCOLS);
    }
}
