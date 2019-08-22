<?php
namespace Imi\SwooleTracker\Example\HttpServer\ApiServer\Controller;

use Imi\Controller\HttpController;
use Imi\Log\Log;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;

/**
 * @Controller("/")
 */
class IndexController extends HttpController
{
    /**
     * @Action
     * @Route("/")
     *
     * @return void
     */
    public function index()
    {
        return $this->response->write('imi niubi');
    }

    /**
     * @Action
     *
     * @return void
     */
    public function fail()
    {
        throw new \RuntimeException('test gg');
    }

}
