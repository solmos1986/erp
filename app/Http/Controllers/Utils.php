<?php
namespace App\Http\Controllers;

class Utils
{

    public static function jsonLog($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
