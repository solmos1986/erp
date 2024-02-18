<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class salida_producto_almacen extends Model
{
    protected $table = 'salida_producto_almacen'; //inidica a que tabla va a direccionarse este modelo
    protected $primaryKey = 'salida_producto_almacen_id'; // indica cual es la columna de conexión con esa tabla
    public $timestamps = false; // timestamps permite agregar dos columnas a la tabla para control de fecha de creación y edición de cada item de esta tabla

    protected $fillable = [ ///especifica los campos que recibiran un valor que se almacenaran en la base de datos
        'serie',
        'producto_id',
        'idDetalleIngreso',
        'id_almacen',
    ];
}
