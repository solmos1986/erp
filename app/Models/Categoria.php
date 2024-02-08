<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';
    protected $primaryKey='idCategoria';
    public $timestamps=false;

    protected $fillable=[
        'idCategoria',
        'nomCategoria',
        'condicionCategoria',
    ];
    protected $guarded=[

    ];
}
