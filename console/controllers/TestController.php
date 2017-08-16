<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 8/16/17
 * Time: 7:16 PM
 */

namespace console\controllers;


use yii\console\Controller;

class TestController extends Controller
{
    public function actionTest()
    {
        $serv = new \Swoole\Http\Server("127.0.0.1", 9502);

        $serv->on('Request', function($request, $response) {
            var_dump($request->get);
            var_dump($request->post);
            var_dump($request->cookie);
            var_dump($request->files);
            var_dump($request->header);
            var_dump($request->server);

            $response->cookie("User", "Swoole");
            $response->header("X-Server", "Swoole");
            $response->end("<h1>Hello Swoole!</h1>");
        });

        $serv->start();
    }
}