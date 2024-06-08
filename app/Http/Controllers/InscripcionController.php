<?php

namespace App\Http\Controllers;

use App\Http\Controllers\InscripcionController;

//hace referencia a nuestro request

use App\Http\Controllers\Utils;
use App\SocketCliente\Usuario;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Luecano\NumeroALetras\NumeroALetras;
use Validator;
use Yajra\DataTables\DataTables;

class InscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        Log::info("Inscripcion/index " . Utils::jsonLog($request->all()));
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $metodo_pago = DB::table('metodo_pago')
            ->join('asientos_frecuentes', 'asientos_frecuentes.idMetodoPago', 'metodo_pago.idMetodoPago')
            ->where('asientos_frecuentes.idTipoMovimiento', '1')
            ->where('condicionTipoPago', '=', '1')
            ->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        // dump($request, "PASE POR CONTROLLER INDEX");

        if ($request->ajax()) {
            $query = trim($request->get('searchText'));
            $data = DB::table('ingresos as in')
                ->select(
                    'in.idIngreso',
                    DB::raw('DATE_FORMAT(in.created_at, "%d-%m-%Y") as created_at'),
                    'c.nomCliente',
                    'tc.nomTipoComprobante',
                    'm.numComprobante',
                    'mp.nomMetodoPago',
                    'di.costoPaquete',
                    'u.nomUsuario',
                    'in.idEstadoIngreso',
                    'di.*',
                    DB::raw('DATE_FORMAT(di.fechaInicio, "%d-%m-%Y") as fechaInicio'),
                    DB::raw('DATE_FORMAT(di.fechaFin, "%d-%m-%Y") as fechaFin'),
                )
                ->join('cliente as c', 'in.idCliente', '=', 'c.idCliente')
                ->join('detalle_inscripcion as di', 'in.idIngreso', '=', 'di.idIngreso')
                ->join('movimientos as m', 'm.idMovimiento', '=', 'in.idMovimiento')
                ->join('tipo_comprobante as tc', 'm.idTipoComprobante', '=', 'tc.idTipoComprobante')
                ->join('metodo_pago as mp', 'm.idMetodoPago', '=', 'mp.idMetodoPago')
                ->join('usuario as u', 'm.idUsuario', '=', 'u.idUsuario')
                ->when(($request->get('startDate') != '' && $request->get('endDate') != ''), function ($query) use ($request) {
                    $query->where('in.created_at', '>=', $request->get('startDate'))
                        ->where('in.created_at', '<=', $request->get('endDate'));
                })
                ->when(($request->get('idCliente') != 'null' && $request->get('idCliente') != ''), function ($query) use ($request) {
                    $query->where('in.idCliente', '=', $request->get('idCliente'));
                })
                ->when(($request->get('idTipoComprobante') != ''), function ($query) use ($request) {
                    $query->where('m.idTipoComprobante', '=', $request->get('idTipoComprobante'));

                })
                ->when(($request->get('idMetodoPago') != ''), function ($query) use ($request) {
                    $query->where('m.idMetodoPago', '=', $request->get('idMetodoPago'));
                })
                ->when(($request->get('idUsuario') != ''), function ($query) use ($request) {
                    $query->where('m.idUsuario', '=', $request->get('idUsuario'));
                })
                ->groupBy('in.idIngreso')
                ->get();
            /* return view('comercial.compra.index',compact('data')); */
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('comercial/inscripcion/index', ['cliente' => $cliente, 'metodo_pago' => $metodo_pago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);
    }
    public function pdf(Request $request, $id)
    {
        $inscripcion = DB::table('ingresos as in')
            ->select(
                'in.idIngreso',
                'in.created_at',
                'in.idCliente',
                'c.nomCliente',
                'tc.nomTipoComprobante',
                'mp.nomMetodoPago',
                'u.nomUsuario',
                'ei.nomEstado',
                'di.costoPaquete',
            )
            ->join('cliente as c', 'in.idCliente', '=', 'c.idCliente')
            ->join('detalle_inscripcion as di', 'in.idIngreso', '=', 'di.idIngreso')
            ->join('movimientos as m', 'm.idMovimiento', '=', 'in.idMovimiento')
            ->join('tipo_comprobante as tc', 'm.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('metodo_pago as mp', 'm.idMetodoPago', '=', 'mp.idMetodoPago')
            ->join('estado_ingreso as ei', 'ei.idEstadoIngreso', '=', 'in.idEstadoIngreso') 
            ->join('usuario as u', 'm.idUsuario', '=', 'u.idUsuario')
            ->where('di.idDetalleInscripcion', '=', $id)
            ->first();
        $detalle = DB::table('detalle_inscripcion as di')
            ->select('di.idPaquete', 'pg.nomPaquete', 'di.costoPaquete')
            ->join('paquetesgym as pg', 'di.idPaquete', '=', 'pg.idPaquete')
            ->join('ingresos as in', 'in.idIngreso', '=', 'di.idIngreso')
            ->where('di.idDetalleInscripcion', '=', $id)
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
        $metodo_pago = DB::table('metodo_pago')
            ->join('asientos_frecuentes', 'asientos_frecuentes.idMetodoPago', 'metodo_pago.idMetodoPago')
            ->where('asientos_frecuentes.idTipoMovimiento', '1')
            ->where('condicionTipoPago', '=', '1')
            ->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $paquetes = DB::table('paquetesgym')->where('condicionPaquete', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        $estado_ingreso = DB::table('estado_ingreso')
            ->where('condicionEstado', '=', '1')
            ->where('estado_ingreso.idEstadoIngreso', '=', '2') //venta
            ->get();
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
        return view('comercial/inscripcion/create', compact('cliente', 'metodo_pago', 'tipo_comprobante', 'paquetes', 'usuario', 'estado_ingreso'));
    }
    public function store(Request $request)
    {
        Log::info("InscripcionController/store " . Utils::jsonLog($request->all()));
        $rules = array(
            'idCliente' => 'required',
            'idMetodoPago' => 'required',
            'idTipoComprobante' => 'required',
        );
        $messages = [
            'idCliente.required' => "Seleccione cliente",
            'idMetodoPago.required' => "Seleccione metodo de pago",
            'idTipoComprobante.required' => "Seleccione Tipo comprobante",
        ];
        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }

        $insertMovimiento = DB::table('movimientos')
            ->insertGetId([
                'idTipoMovimiento' => 1,
                'idUsuario' => auth()->user()->obtener_usuario()->idUsuario,
                'descripcion' => $this->crear_glosa($request),
                'totalMov' => $request->costoPaquete,
                'idProyecto' => 1,
                'idMetodoPago' => $request->idMetodoPago,
                'idTipoComprobante' => $request->idTipoComprobante,
                'numComprobante' => date('dmY') . '-' . date('Hms'),
                'razon_social' => $this->crear_recibir_entregar($request),
            ]);

        $insertInscripcion = DB::table('ingresos')
            ->insertGetId([
                'idMovimiento' => $insertMovimiento,
                'idTipoIngreso' => 1,
                'idCliente' => $request->idCliente,
                'idEstadoIngreso' => $request->idEstadoIngreso,
            ]);
        //set fechas
        $fechaInicio = date('Y-m-d', strtotime(str_replace('/', '-', $request->fechaInicio))) . ' 00:00:00';
        $fechaFin = date('Y-m-d', strtotime(str_replace('/', '-', $request->fechaFin))) . ' 23:59:59';
        $estado = $this->estado_inscripcion($fechaInicio);
        Log::info("InscripcionController/store estado_inscripcion => " . $estado);

        $insertDetalleInscripcion = DB::table('detalle_inscripcion')->insertGetId([
            'idIngreso' => $insertInscripcion,
            'idPaquete' => $request->idPaquete,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'costoPaquete' => $request->costoPaquete,
            'estadoInscripcion' => $estado,
        ]);

        if ($request->idEstadoIngreso == 2) {
            $generar_asiento = $this->generar_asiento($request->idMetodoPago, $insertMovimiento, $request->costoPaquete, $request);
        }

        /* if ($estado == 'vig') {
            Log::info("InscripcionController/store activando socket por el estado => " . $estado);
            $this->insertWebSocket($request->idCliente, $insertDetalleInscripcion, $fechaInicio, $fechaFin);
        } */

        return response()->json([
            "status" => 1,
            "message" => "Guardado correctamente",
            "data" => $insertInscripcion,
        ]);
    }

    public function calculo_total(Request $request)
    {
        $total = 0;
        foreach ($request->detalleVenta as $key => $value) {
            $total += intval($value['cantidad']) * intval($value['precio']);
        }
        return $total;
    }

    private function crear_glosa(Request $request)
    {
        $paquete = DB::table('paquetesgym')
            ->where('paquetesgym.idPaquete', $request->idPaquete)
            ->first();
        return 'concepto de inscripcion Paq:' . $paquete->idPaquete . '-' . $paquete->nomPaquete . ' Fecha inicio:' . $request->fechaInicio . ' Fecha fin:' . $request->fechaFin;
    }
    private function crear_recibir_entregar(Request $request)
    {
        $cliente = DB::table('cliente')->where('cliente.idCliente', $request->idCliente)->first();
        return 'Venta de inscripcion para cliente ' . $cliente->docCliente.' '.$cliente->nomCliente;
    }

    public function generar_asiento($idMetodoPago, $insertMovimiento, $totalMovimiento, Request $request)
    {
        $cuentas_frecuente = DB::table('asientos_frecuentes')
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
            ->where('asientos_frecuentes.idMetodoPago', $idMetodoPago)
            ->get();
        foreach ($cuentas_frecuente as $key => $cuenta) {
            $inserAsiento = DB::table('asientos')
                ->insertGetId([
                    'idMovimiento' => $insertMovimiento,
                    'idCuenta' => $cuenta->idCuenta,
                    'debe' => floatval($cuenta->debe) * floatval($totalMovimiento),
                    'haber' => floatval($cuenta->haber) * floatval($totalMovimiento),
                ]);
        }
    }

    public function estado_inscripcion($fechaInicio)
    {
        $fechaActual = date('Y-m-d');
        $fechaInicio = date('Y-m-d', strtotime($fechaInicio));
        Log::info("InscripcionController/estado_inscripcion comparar => fecha inicio " . $fechaInicio . ' y fecha actual  ' . $fechaActual);
        if ($fechaInicio > $fechaActual) {
            return 'ant';
        } else {
            return 'vig';
        }
    }
    public function insertWebSocket($idCliente, $idDetalleInscripcion, $fechaInicio, $fechaFin)
    {
        $socket = new Usuario();
        $cliente = DB::table('cliente')
            ->where('idCliente', $idCliente)
            ->first();
        $socket->store_cliente([
            'idDetalleInscripcion' => $idDetalleInscripcion,
            'idCliente' => $cliente->idCliente,
            'docCliente' => $cliente->docCliente,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'nomCliente' => $cliente->nomCliente,
            'fotoCliente' => $cliente->fotoCliente,
        ]);
    }

    public function eliminar_clientes_dispositivo()
    {
        $socket = new Usuario();
        $socket->eliminar_clientes_automatico([]);
        return response()->json([
            "status" => 1,
            "message" => "Socket activado",
            "data" => null,
        ]);
    }
}
