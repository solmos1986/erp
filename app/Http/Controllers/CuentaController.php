<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CuentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataTable()
    {
        $cuentas = DB::table('cuenta')
            ->select(
                'cuenta.*',
                DB::raw('"0" as debe'),
                DB::raw('"0" as haber'),
                DB::raw('"0" as saldo')
            )
            ->orderBy('cuenta.codigo_cuenta')
            ->get();
        return Datatables::of($cuentas)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = [];
        return view('cuenta.index', compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cuenta_padre = DB::table('cuenta')
            ->where('cuenta.cuenta_id', $id)
            ->first();

        $cuenta_padre->nuevo_codigo = $this->generar_codigo_cuenta($cuenta_padre);
        return response()->json([
            "status" => 1,
            "message" => "Mostrar cuenta",
            "data" => $cuenta_padre,
        ]);
    }
    public function generar_codigo_cuenta($cuenta_padre)
    {
        $ultima_cuenta = DB::table('cuenta')
            ->where('cuenta.padre_cuenta_id', $cuenta_padre->cuenta_id)
            ->orderBy('cuenta.codigo_cuenta', 'DESC')
            ->first();
        if ($ultima_cuenta) {
            $ultimo_numero = substr($ultima_cuenta->codigo_cuenta, -1, 1);
        } else {
            $ultimo_numero = 0;
        }

        if ($cuenta_padre->orden_cuenta_id >= 4) {
            $codigo = (intval($cuenta_padre->codigo_cuenta) * 1000) + (intval($ultimo_numero) + 1);
        } else {
            $codigo = (intval($cuenta_padre->codigo_cuenta) * 100) + (intval($ultimo_numero) + 1);
        }
        return $codigo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuenta_padre = DB::table('cuenta')
            ->where('cuenta.cuenta_id', $request->cuenta_id)
            ->first();

        $nuevo_codigo = $this->generar_codigo_cuenta($cuenta_padre);
        $cuenta = DB::table('cuenta')->insert([
            'padre_cuenta_id' => $request->cuenta_id,
            'nombre_cuenta' => $request->nombre_cuenta,
            'codigo_cuenta' => $nuevo_codigo,
            'orden_cuenta_id' => (intval($cuenta_padre->orden_cuenta_id) + 1),
        ]);
        return response()->json([
            "status" => 1,
            "message" => "Registrado correctamnte",
            "data" => $cuenta,
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
        $cuenta = DB::table('cuenta')
            ->where('cuenta.cuenta_id', $id)
            ->first();
        return response()->json([
            "status" => 1,
            "message" => "Mostrar cuenta",
            "data" => $cuenta,
        ]);
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
        $cuenta = DB::table('cuenta')
            ->where('cuenta.cuenta_id', $id)
            ->update([
                'cuenta_id' => $request->cuenta_id,
                'nombre_cuenta' => $request->nombre_cuenta,
                'codigo_cuenta' => $request->codigo_cuenta,
                'orden_cuenta_id' => $request->orden_cuenta_id,
            ]);
        return response()->json([
            "status" => 1,
            "message" => "Registrado correctamnte",
            "data" => $cuenta,
        ]);
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
