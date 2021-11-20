<?php
/**
 *
 *
 * Created by PhpStorm
 * User: Alex
 * Date: 2021-11-21 04:16
 * E-mail: <276558492@qq.com>
 */
declare(strict_types=1);

namespace App\Grpc;

use Grpc\HiRequest;
use Grpc\HiResponse;
use Grpc\UserResponseEntity;

class HelloGrpc
{

    public function sayHello(HiRequest $request)
    {
        var_dump('request name ==> ', $request->getName());
        var_dump('request sex ==> ', $request->getSex());

        $response = new HiResponse();
        $response->setCode(200);
        $response->setMessage('Success');

        $user = new UserResponseEntity();
        $user->setName('response ==> ' . $request->getName());
        $user->setSex($request->getSex() * 10);

        $response->setData($user);

        return $response;
    }


}