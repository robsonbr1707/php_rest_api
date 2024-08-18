<?php

namespace App\Http;

class Method
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
}