<?php

namespace App\Config;

use PDO;

class Database
{
    public static function connection()
    {
        try {
            # Creedenciais do banco
            $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=local_php_mvc_template';
            $config = [
                'dsn'       => $dsn,
                'username'  => 'root',
                'password'  => '',
                'options'   => array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                )
            ];
            
           return new \PDO($config['dsn'], $config['username'], $config['password'], $config['options']);
            
        } catch (\PDOException $e) {
            echo throw 'Error ao conectar no banco de dados'. $e->getMessage();
        }
    }
}