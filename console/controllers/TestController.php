<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 8/16/17
 * Time: 7:16 PM
 */

namespace console\controllers;


use common\config\Env;
use yii\console\Controller;

class TestController extends Controller
{
    /**
     * this is a test
     */
    public function actionTest()
    {
        var_dump(Env::DOMAIN);
        var_dump(\Yii::$app->user->identity->toArray());
    }

    public function actionSwooleWebsocketStart()
    {
        $server = new \swoole_websocket_server("127.0.0.1", 9502);

        $server->on('open', function($server, $req) {
            echo "connection open: {$req->fd}\n";
        });

        $server->on('message', function($server, $frame) {
            echo "received message: {$frame->data}\n";
            $server->push($frame->fd, json_encode(["hello", "world"]));
        });

        $server->on('close', function($server, $fd) {
            echo "connection close: {$fd}\n";
        });

        $server->start();
    }
}