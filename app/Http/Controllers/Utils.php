<?php
namespace App\Http\Controllers;

use File;

class Utils
{

    public static function jsonLog($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }
    public static function FileToBase64($nameFile)
    {
        try {
            $path = public_path() . '/imagenes/clientes/' . $nameFile . '';
            $extencion = pathinfo($path, PATHINFO_EXTENSION);
            $image = base64_encode(file_get_contents($path));
            return "data:image/$extencion;base64, $image";
        } catch (\Throwable $th) {
            return "";
        }
    }
    public static function Base64toFile($base64, $name, $path)
    {
        File::put(public_path() . '/imagenes/clientes/' . $name, file_get_contents($base64));
        return File::get(public_path() . '/imagenes/clientes/' . $name);
    }
}
