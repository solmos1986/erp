<?php

namespace App\Http\Controllers;

use App\Http\Controllers\InscripcionController;

//hace referencia a nuestro request
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InscripcionController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {

        if ($request->ajax()) {
            $query = trim($request->get('searchText'));
            $data = DB::table('inscripcion as in')
                ->join('cliente as c', 'in.idCliente', '=', 'c.idCliente')
                ->join('detalle_inscripcion as di', 'in.idInscripcion', '=', 'di.idInscripcion')
                ->join('tipo_comprobante as tc', 'in.idTipoComprobante', '=', 'tc.idTipoComprobante')
                ->join('tipopago as tp', 'in.idTipoPago', '=', 'tp.idTipoPago')
                ->select('in.idInscripcion', 'in.fechaInscripcion', 'c.nomCliente', 'tc.nomTipoComprobante', 'in.impuestoInscripcion', 'tp.nomTipoPago', 'di.costoPaquete', 'in.estadoInscripcion')
                ->where('tc.nomTipoComprobante', 'LIKE', '%' . $query . '%')

                ->groupBy('in.idInscripcion', 'in.fechaInscripcion', 'c.nomCliente', 'tc.nomTipoComprobante', 'in.impuestoInscripcion', 'tp.nomTipoPago', 'di.costoPaquete', 'in.estadoInscripcion')
                ->get();
            /*  dd($data, "HOLAAA"); */
            /* return view('comercial.compra.index',compact('data')); */
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }

        return view('comercial/inscripcion/index');

    }
    public function create(Request $request)
    {
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $paquetes = DB::table('paquetesgym')->where('condicionPaquete', '=', '1')->get();
        if ($request->ajax()) {
            $data = DB::table('paquetes')
                ->where('condicionPaquete', '=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }

        return view('comercial/inscripcion/create', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'paquetes' => $paquetes]);

    }
    public function store(Request $request)
    {
        $insertInscripcion = DB::table('inscripcion')
            ->insertGetId([
                'idCliente' => $request->idCliente,
                'idTipoPago' => $request->idTipoPago,
                'idTipoComprobante' => $request->idTipoComprobante,
                'fechaInscripcion' => now(),
                'impuestoInscripcion' => $request->impuestoInscripcion,
                'estadoInscripcion' => $request->estadoInscripcion,
                'idUsuario' => $request->idUsuario,
            ]);
        $insertDetalleInscripcion = DB::table('detalle_inscripcion')->insertGetId([
            'idInscripcion' => $insertInscripcion,
            'idCliente' => $request->idCliente,
            'idPaquete' => $request->idPaquete,
            'fechaInicio' => $request->fechaInicio,
            'fechaFin' => $request->fechaFin,
            'costoPaquete' => $request->costoPaquete,
        ]);
        return response()->json([
            "status" => 1,
            "message" => "GuarDado correctamnte",
            "data" => null,
        ]);

    }
}