<?php
/**
 *
 *
 * Created by PhpStorm
 * User: Alex
 * Date: 2021-11-21 04:27
 * E-mail: <276558492@qq.com>
 */
declare(strict_types=1);

namespace App\Grpc;

use Hyperf\GrpcClient\BaseClient;
use Grpc\HiRequest;
use Grpc\HiResponse;

class HelloClient extends BaseClient
{

    public function sayHelloClient(HiRequest $request)
    {
        return $this->_simpleRequest(
            '/grpc.hello/sayHello',
            $request,
            [HiResponse::class, 'decode']
        );
    }

}