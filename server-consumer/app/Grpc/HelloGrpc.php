<?php
/**
 *
 *
 * Created by PhpStorm
 * User: Alex
 * Date: 2021-11-21 04:25
 * E-mail: <276558492@qq.com>
 */
declare(strict_types=1);

namespace App\Grpc;

use Grpc\HiRequest;
use Grpc\HiResponse;

class HelloGrpc
{

    public function say($params = [])
    {
        $client = new HelloClient('127.0.0.1:9512', [
            'credentials' => null,
        ]);

        $requst = new HiRequest();
        $requst->setName($params['name'] ?? 'Alex');
        $requst->setSex($params['sex'] ?? 2);

        /**
         * @var HiResponse $response
         */
        list($response, $status) = $client->sayHelloClient($requst);
        $code = $response->getCode();
        $msg = $response->getMessage();

        $userRsp = $response->getData();
        $data = [
            'name' => $userRsp->getName(),
            'sex' => $userRsp->getSex()
        ];

        var_dump(memory_get_usage(true));

        return compact('code', 'msg', 'data');
    }

}