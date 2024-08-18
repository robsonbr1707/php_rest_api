<?php

namespace App\Core;

use App\Config\Database;
use App\Http\Response;
use PDO;

abstract class Model extends Database
{
    protected static string $table = '';
    protected static array $fillable = [];

    public static function all(string $fields = "*")
    {
        $db = self::connection();

        $stmt = $db->prepare("SELECT $fields FROM ". static::$table);
        $stmt->execute();

        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;
    }

    public static function create(array $datas)
    {
        $db = self::connection();

        $columns = '';
        $values = [];
        $valSql = '';
        $valKey = 0;
        
        foreach ($datas as $field => $value) {
            if (in_array($field, static::$fillable)) {
                $valKey++;
                $columns .= "$field,";
                $values[$valKey] = $value;
                $valSql .= "?,";
            }
        }
        
        $colSql = rtrim($columns, ',');
        $valSql = rtrim($valSql, ',');
        
        $stmt = $db->prepare("INSERT INTO ". static::$table . "({$colSql}) VALUES ({$valSql})");
        foreach ($values as $key => $data) {
            $stmt->bindValue($key, $data, gettype($data) == 'integer' ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
    }

    public static function update(int $id, array $datas)
    {
        self::findOrFail($id);
        $db = self::connection();
        
        $columns = '';
        $values = [];
        $valKey = 0;
        
        foreach ($datas as $field => $value) {
            if (in_array($field, static::$fillable)) {
                $valKey++;
                $columns .= "$field = ?,";
                $values[$valKey] = $value;
            }
        }

        $columns = rtrim($columns, ',');
        $values[$valKey + 1] = $id;

        $stmt = $db->prepare("UPDATE ". static::$table . " SET {$columns} WHERE id = ?");
        foreach ($values as $key => $data) {
            $stmt->bindValue($key, $data, gettype($data) == 'integer' ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
    }

    public static function findOrFail(int $id, ?string $fields = "*")
    {
        $db = self::connection();

        $stmt = $db->prepare("SELECT {$fields} FROM " . static::$table . " WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$fetch) {
            return Response::json(['message' => "Registro não encontrado!"], 302);
        }

        return $fetch;
    }

    public static function delete(int $id)
    {
        self::findOrFail($id);
        $db = self::connection();
        
        $stmt = $db->prepare("DELETE FROM ". static::$table ." WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}