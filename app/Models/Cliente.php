<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   protected $table='cliente'; //inidica a que tabla va a direccionarse este modelo
    protected $primaryKey='idCliente'; // indica cual es la columna de conexión con esa tabla
    public $timestamps=false; // timestamps permite agregar dos columnas a la tabla para control de fecha de creación y edición de cada item de esta tabla

    protected $fillable=[ ///especifica los campos que recibiran un valor que se almacenaran en la base de datos
    	'idCliente',
        'nomCliente',
    	'docCliente',
    	'tel1Cliente',
    	'tel2Cliente',
    	'dirCliente',
        'mailCliente',
        'CondicionCliente',
    ];
    protected $guarded=[

    ];
}
