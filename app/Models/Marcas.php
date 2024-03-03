<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $table = 'marcas';
    protected $primaryKey = 'idMarcas';
    public $timestamps = false;

    protected $fillable = [
        'idMarcas',
        'nomMarcas',
        'condicionMarcas',
    ];
    protected $guarded = [

    ];
}
