<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipo_comprobante extends Model
{
    protected $table = 'tipo_comprobante';
    protected $primaryKey = 'idTipoComprobante';
    public $timestamps = false;

    protected $fillable = [
        'idTipoComprobante',
        'nomTipoComprobante',
        'condicionTipo_Comprobante',
    ];
    protected $guarded = [

    ];
}
