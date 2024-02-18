<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto'; //inidica a que tabla va a direccionarse este modelo
    protected $primaryKey = 'idProducto'; // indica cual es la columna de conexión con esa tabla
    public $timestamps = false; // timestamps permite agregar dos columnas a la tabla para control de fecha de creación y edición de cada item de esta tabla

    protected $fillable = [ ///especifica los campos que recibiran un valor que se almacenaran en la base de datos
        'idProducto',
        'codProducto',
        'nomProducto',
        'stockMinimo',
        'unidadMedida',
        'imagenProducto',
        'idCategoria',
        'condicionProducto',
        'precioVentaProducto',
    ];
    protected $guarded = [

    ];
}
