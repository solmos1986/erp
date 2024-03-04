<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    protected $table = 'tipopago';
    protected $primaryKey = 'idTipoPago';
    public $timestamps = false;

    protected $fillable = [
        'idTipoPago',
        'nomTipoPago',
        'condicionTipoPago',
    ];
    protected $guarded = [

    ];
}
