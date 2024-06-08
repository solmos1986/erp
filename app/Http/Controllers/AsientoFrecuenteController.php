<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AsientoFrecuenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function obtenerCuentaFrecuente($id)
    {
        //obtener tipo egreso
        $cuentas = DB::table('asientos_frecuentes')
            ->select(
                'detalle_asiento_frecuente.*',
                'cuenta.*',
                'metodo_pago.*',
                'tipo_movimientos.*'
            )
            ->join('detalle_asiento_frecuente', 'detalle_asiento_frecuente.idAsientoFrecuente', 'asientos_frecuentes.idAsientoFrecuente')
            ->join('cuenta', 'cuenta.cuenta_id', 'detalle_asiento_frecuente.idCuenta')
            ->join('metodo_pago', 'asientos_frecuentes.idMetodoPago', 'metodo_pago.idMetodoPago')
            ->join('tipo_movimientos', 'tipo_movimientos.idTipoMovimiento', 'asientos_frecuentes.idTipoMovimiento')
            ->where('asientos_frecuentes.idMetodoPago', $id)
            ->get();
        return response()->json([
            "status" => 1,
            "message" => "cuentas obtenida correctamente",
            "data" => $cuentas,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
