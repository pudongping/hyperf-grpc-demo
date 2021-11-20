<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', function () {
    return '';
});


// 定义 grpc 服务路由
Router::addServer('grpc', function () {
    Router::addGroup('/grpc.hello', function () {
        Router::post('/sayHello', 'App\Grpc\HelloGrpc@sayHello');
    });
});