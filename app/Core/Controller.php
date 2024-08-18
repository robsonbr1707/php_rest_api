<?php

namespace App\Core;

use App\Http\Request;
use App\Http\Response;

abstract class Controller
{
    protected object $request;
    protected object $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}