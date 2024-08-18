<?php

use App\Core\Route;

$routes = [
    'get'    => [
        ['/', 'HomeController@index'],
        //-- Exemplos --\\
        ['/exemplos', 'ExampleController@index'],
        ['/exemplos/{id}', 'ExampleController@show'],
    ],

    'post'   => [
        //-- Exemplos --\\
        ['/exemplos', 'ExampleController@store'],
    ],

    'put'    => [
        //-- Exemplos --\\
        ['/exemplos/{id}', 'ExampleController@update'],
    ],

    'delete' => [
        //-- Exemplos --\\
        ['/exemplos/{id}', 'ExampleController@delete'],
    ]
];

$router = new Route($routes);
$router->add();