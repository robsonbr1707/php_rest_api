<?php

namespace App\Core;

use App\Http\Response;

abstract class Validator
{
    protected static array $errors;
    protected static array $datas;

    public static function filterFields(string|array $field, array $rules, string|int $value)
    {
        try {
            foreach ($rules as $rule) {
            
                if (str_contains($rule, ':')) {
                    $field = [$field, explode(':', $rule)];
                    $rule = $field[1][0];
                }
    
                self::$rule($field, htmlspecialchars(trim($value), ENT_QUOTES));
            }
            
            if (!empty(self::$errors)) {
                return Response::json(['message' => self::$errors], 203);
            }
    
            return self::$datas;
        } catch (\Throwable $e) {
            return Response::json(['message' => "Erro inesperado ao validar"]);
        }
    }

    public static function required(string $field, string|int $value)
    {
        if (empty($value)) {
            return self::$errors[$field] = "Campo $field obrigatório!";
        }

        return self::$datas[$field] = $value;
    }

    public static function max(array $field, string|int $value)
    {
        if (strlen($value) > $field[1][1]) {
            return self::$errors[$field[0]] = "Campo $field[0] é necessário ter menos que " . $field[1][1] . " caracteres!";
        }

        return self::$datas[$field[0]] = $value;
    }

    public static function min(array $field, string|int $value)
    {
        if (strlen($value) > $field[1][1]) {
            return self::$errors[$field[0]] = "Campo $field[0] é necessário ter mais que " . $field[1][1] . " caracteres!";
        }

        return self::$datas[$field[0]] = $value;
    }
}