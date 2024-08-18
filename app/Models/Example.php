<?php

namespace App\Models;

use App\Core\Model;

class Example extends Model
{
    # Tabela
    protected static string $table = 'examples';
    # Colunas permitidas a serem modificadas
    protected static array $fillable = [
        'title',
        'slug',
        'sub_title',
        'content'
    ];
}