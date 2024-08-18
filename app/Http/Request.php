<?php

namespace App\Http;

class Request
{
    public static function method(): string
    {
        $methods = ['get', 'post', 'put', 'delete'];
        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);

        if (in_array($requestMethod, $methods)) {
            return $requestMethod;
        }

        return 'get';
    }

    public static function body()
    {
        $datas = json_decode(file_get_contents('php://input'), true) ?? [];

        $json = match (self::method()) {
            'get' => $_GET,
            'post', 'put', 'delete' => $datas,
        };

        return $json;
    }
}