<?php

namespace App\Validation;

use App\Core\Validator;
use App\Http\Method;

class ExampleValidate extends Validator
{
    private static function rules()
    {
        return match (Method::method()) {
            'post' => [
                'title'     => ['required', 'max:10'],
                'slug'      => ['required', 'max:10'],
                'sub_title' => ['required', 'max:20'],
                'content'   => ['required', 'max:20']
            ],
            'put'  => [
                'title'     => ['required', 'max:10'],
                'slug'      => ['required', 'max:10'],
                'sub_title' => ['required', 'max:20'],
                'content'   => ['required', 'max:20']
            ],
        };
    }

    public static function validate(array $datas)
    {
        $fields = self::rules();
        
        foreach ($datas as $field => $data) {
            if (in_array($fields[$field], $fields)) {
                self::filterFields($field, $fields[$field], $data);
            }
        }

        return parent::$datas;
    }
}