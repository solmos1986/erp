<?php

namespace App\Http\Controllers;

use App\Models\entrada_producto_almacen;
use DB;
use Illuminate\Http\Request;

//para hacer algunas redirecciones

class EntradaProductoAlmacen extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
    public function create($id)
    {
        $egreso = DB::table('egresos')
            ->select(
                'egresos.*',
                'proveedor.*',
                'usuario.*',
                DB::raw('DATE_FORMAT(egresos.created_at, "%d-%m-%Y %H:%i:%s") as created_at'),
                DB::raw('SUM(detalle_compra.precioCompra*detalle_compra.cantidadCompra) as monto_total')
            )
            ->join('detalle_compra', 'detalle_compra.idEgreso', 'egresos.idEgreso')
            ->join('movimientos', 'movimientos.idMovimiento', 'egresos.idMovimiento')
            ->join('proveedor', 'proveedor.idProveedor', 'egresos.idProveedor')
            ->join('usuario', 'usuario.idUsuario', 'movimientos.idUsuario')
            ->where('detalle_compra.idEgreso', $id)
            ->first();

        return view('entrada-producto.create', compact('egreso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $entradas = [];
        foreach ($request->entradas as $key => $entrada) {
            $entradas[] = [
                'serie' => $entrada['serie'] == null ? '' : $entrada['serie'],
                'idProducto' => $entrada['idProducto'],
                'detalle_compra_id' => $entrada['detalle_compra_id'],
                'idAlmacen' => $entrada['idAlmacen'],
                'fecha_vencimiento' => strtotime($entrada['fecha_vencimiento']) == null ? '' : date('Y-m-d', strtotime($entrada['fecha_vencimiento'])),
            ];
        }
        $update_egreso = DB::table('egresos')
            ->where('egresos.idEgreso', $id)
            ->update([
                'idEstadoEgreso' => 2,
            ]);
        entrada_producto_almacen::insert($entradas);
        return response()->json([
            "status" => 1,
            "message" => "Porductos registrados",
            "data" => count($entradas),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    public function dataTable($id)
    {
        $detalle_egresos = DB::table('detalle_compra')
            ->join('producto', 'producto.idProducto', 'detalle_compra.idProducto')
            ->where('detalle_compra.idEgreso', $id)
            ->get();
        $almacenes = DB::table('almacen')->get();
        $datos = [];
        $count = 1;
        foreach ($detalle_egresos as $key => $detalle_egreso) {
            for ($i = 1; $i <= $detalle_egreso->cantidadCompra; $i++) {
                array_push($datos, array(
                    'serie' => '',
                    'idProducto' => $detalle_egreso->idProducto,
                    'codProducto' => $detalle_egreso->codProducto,
                    'nomProducto' => $detalle_egreso->nomProducto,
                    'detalle_compra_id' => $detalle_egreso->detalle_compra_id,
                    'idEntradaAlmacen' => $count++,
                    'idAlmacen' => 1,
                    'create_at' => $detalle_egreso->create_at,
                    'fecha_vencimiento' => '',
                    'almacenes' => $almacenes,
                ));
            }
        }
        return response()->json([
            "status" => 1,
            "message" => "Creando productos",
            "data" => $datos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
