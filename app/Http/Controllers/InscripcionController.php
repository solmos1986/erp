<?php

namespace App\Http\Controllers;

use App\Http\Controllers\InscripcionController;

//hace referencia a nuestro request

use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use Illuminate\Http\Request;
use Luecano\NumeroALetras\NumeroALetras;
use App\SocketCliente\Usuario;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class InscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) //recibe como parametro un objeto tipo request

    {
        Log::info("inciando inscripcion");
//dd($request, "ESTO ESTA LLEGANDO");
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();

        if ($request->ajax()) {
            $query = trim($request->get('searchText'));
            $data = DB::table('inscripcion as in')
                ->select('in.idInscripcion', 'in.fechaInscripcion', 'c.nomCliente', 'tc.nomTipoComprobante', 'in.impuestoInscripcion', 'tp.nomTipoPago', 'di.costoPaquete', 'u.nomUsuario', 'in.estadoInscripcion')
                ->join('cliente as c', 'in.idCliente', '=', 'c.idCliente')
                ->join('detalle_inscripcion as di', 'in.idInscripcion', '=', 'di.idInscripcion')
                ->join('tipo_comprobante as tc', 'in.idTipoComprobante', '=', 'tc.idTipoComprobante')
                ->join('tipopago as tp', 'in.idTipoPago', '=', 'tp.idTipoPago')
                ->join('usuario as u', 'in.idUsuario', '=', 'u.idUsuario')
                ->when(($request->get('startDate') != '' && $request->get('endDate') != ''), function ($query) use ($request) {
                    $query->where('in.fechaInscripcion', '>=', $request->get('startDate'))
                        ->where('in.fechaInscripcion', '<=', $request->get('endDate'));
                })
                ->when(($request->get('idCliente') != ''), function ($query) use ($request) {
                    $query->where('in.idCliente', '=', $request->get('idCliente'));

                })
                ->when(($request->get('idTipoComprobante') != ''), function ($query) use ($request) {
                    $query->where('in.idTipoComprobante', '=', $request->get('idTipoComprobante'));

                })
                ->when(($request->get('idTipoPago') != ''), function ($query) use ($request) {
                    $query->where('in.idTipoPago', '=', $request->get('idTipoPago'));

                })
                ->when(($request->get('idUsuario') != ''), function ($query) use ($request) {
                    $query->where('in.idUsuario', '=', $request->get('idUsuario'));

                })
                ->where('in.fechaInscripcion', '>=', $request->get('startDate'))
                ->where('in.fechaInscripcion', '<=', $request->get('endDate'))
                ->where('tc.nomTipoComprobante', 'LIKE', '%' . $query . '%')

                ->groupBy('in.idInscripcion', 'in.fechaInscripcion', 'c.nomCliente', 'tc.nomTipoComprobante', 'in.impuestoInscripcion', 'tp.nomTipoPago', 'di.costoPaquete', 'u.nomUsuario', 'in.estadoInscripcion')
                ->get();
            /*  dd($data, "HOLAAA"); */
            /* return view('comercial.compra.index',compact('data')); */
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }

        return view('comercial/inscripcion/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);

    }
    public function pdf(Request $request, $id)
    {
        $inscripcion = DB::table('inscripcion as in')
            ->select('in.idInscripcion', 'in.fechaInscripcion', 'in.idCliente', 'c.nomCliente', 'tc.nomTipoComprobante', 'in.impuestoInscripcion', 'tp.nomTipoPago', 'u.nomUsuario', 'in.estadoInscripcion', 'di.costoPaquete')
            ->join('cliente as c', 'in.idCliente', '=', 'c.idCliente')
            ->join('detalle_inscripcion as di', 'in.idInscripcion', '=', 'di.idInscripcion')
            ->join('tipo_comprobante as tc', 'in.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('tipopago as tp', 'in.idTipoPago', '=', 'tp.idTipoPago')
            ->join('usuario as u', 'in.idUsuario', '=', 'u.idUsuario')
            ->where('in.idInscripcion', '=', $id)
            ->first();
        $detalle = DB::table('detalle_inscripcion as di')
            ->select('di.idPaquete', 'pg.nomPaquete', 'di.costoPaquete')
            ->join('paquetesgym as pg', 'di.idPaquete', '=', 'pg.idPaquete')
            ->join('inscripcion as in', 'in.idInscripcion', '=', 'di.idInscripcion')
            ->where('di.idInscripcion', '=', $id)
            ->groupBy('di.idPaquete')
            ->get();

        $infoNego = DB::table('info_negocio')->first();
        $formatter = new NumeroALetras();
        $literal = $formatter->toInvoice($inscripcion->costoPaquete, 2, 'BOLIVIANOS');
        //dd($literal);

        $pdf = Pdf::setPaper([0, 0, 226.77, 2267.72])->loadView('comercial.inscripcion.inscripcion-pdf', ['inscripcion' => $inscripcion, 'detalle' => $detalle, 'infoNego' => $infoNego, 'literal' => $literal]);

        return response()->json([
            'data' => base64_encode($pdf->output()),
        ]);

    }
    public function create(Request $request)
    {
        Log::info("InscripcionController/create()");
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $paquetes = DB::table('paquetesgym')->where('condicionPaquete', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        Log::info("InscripcionController/create inciando");
        if ($request->ajax()) {
            $data = DB::table('paquetes')
                ->where('condicionPaquete', '=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }

        return view('comercial/inscripcion/create', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'paquetes' => $paquetes, 'usuario' => $usuario]);

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
        $socket = new Usuario();
        $socket->store_cliente(['idInscripcion' => $insertInscripcion]);
        return response()->json([
            "status" => 1,
            "message" => "GuarDado correctamnte",
            "data" => $insertInscripcion,
        ]);

    }
}
