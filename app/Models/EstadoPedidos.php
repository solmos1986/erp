<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPedidos extends Model
{
    protected $table = 'estadoInOut';
    protected $primaryKey = 'idEstadoInOut';
    public $timestamps = false;

    protected $fillable = [
        'idEstadoInOut',
        'nomEstadoInOut',
        'condicionEstadoInOut',
    ];
    protected $guarded = [

    ];
}
