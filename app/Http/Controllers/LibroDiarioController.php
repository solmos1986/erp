<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LibroDiarioController extends Controller
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
        $tipo_movimientos = DB::table('tipo_movimientos')->get();
        $ultimo_movimiento = DB::table('movimientos as m')
            ->select(
                DB::raw('MAX(m.idMovimiento) as ultimo')
            )
            ->join('ingresos as i','i.idMovimiento','m.idMovimiento')
            ->where('idEstadoIngreso',2)
            ->first();
        return view('libro-diario/index', compact('tipo_movimientos', 'ultimo_movimiento'));
    }
    public function dataTableMovimientos($id)
    {
        $data = DB::table('movimientos as m')
            ->select(
                'm.*',
                'a.*',
                'c.*',
                DB::raw('DATE_FORMAT(m.created_at, "%d-%m-%Y %H:%i:%s") as created_at'),
            )
            ->join('asientos as a', 'a.idMovimiento', '=', 'm.idMovimiento')
            ->join('cuenta as c', 'c.cuenta_id', '=', 'a.idCuenta')
            ->where('m.idMovimiento', $id)
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }

    public function dataTableLibroDiario(Request $request)
    {
        $data = DB::table('movimientos as m')
            ->select(
                'm.*',
                'a.*',
                'c.*',
                'tm.*',
                DB::raw('DATE_FORMAT(m.created_at, "%d-%m-%Y %H:%i:%s") as created_at'),
            )
            ->join('asientos as a', 'a.idMovimiento', '=', 'm.idMovimiento')
            ->join('cuenta as c', 'c.cuenta_id', '=', 'a.idCuenta')
            ->join('tipo_movimientos as tm', 'tm.idTipoMovimiento', '=', 'm.idTipoMovimiento')
            ->when((date('Y-m-d', strtotime($request->get('desde'))) != '' && date('Y-m-d', strtotime($request->get('hasta'))) != ''), function ($query) use ($request) {
                $query->whereDate('m.created_at', '>=', date('Y-m-d', strtotime($request->get('desde'))))
                    ->whereDate('m.created_at', '<=', date('Y-m-d', strtotime($request->get('hasta'))));
            })
            ->groupBy('m.idMovimiento')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
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
        $movimiento = DB::table('movimientos as m')
            ->select(
                'm.*',
                'tc.*',
                'tm.*'
            )
            ->join('tipo_movimientos as tm', 'tm.idTipoMovimiento', '=', 'm.idTipoMovimiento')
            ->join('tipo_comprobante as tc', 'tc.idTipoComprobante', '=', 'm.idTipoComprobante')
            ->where('m.idMovimiento', $id)
            ->first();

        return response()->json([
            "status" => 1,
            "message" => "Mostrar Movimiento",
            "data" => $movimiento,
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
