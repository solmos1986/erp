<?php

namespace App\Http\Controllers;

//hace referencia a nuestro request

use App\Http\Controllers\Utils;
use App\SocketCliente\Usuario;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Luecano\NumeroALetras\NumeroALetras;
use Validator;
use Yajra\DataTables\DataTables;

class IngresosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request, $tipoIngreso) //recibe como parametro un objeto tipo request
    {
        Log::info("inciando ingreso");
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();

        switch ($tipoIngreso) {
            case '1':
                return view('comercial/venta/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);

                break;
            case '2':
                return view('comercial/inscripcion/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);
                break;
            case '3':
                return view('contabilidad/ingresos/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);

                break;
        }

    }
    public function obtener_ingresos(Request $request)
    {
        $tipoIngreso = $request->get('idTipoIngreso');
        //dd($tipoIngreso, "TIPO INGRESO");
        $query = trim($request->get('searchText'));
        $data = DB::table('ingreso as in')
            ->select('in.idIngreso', 'in.idTipoIngreso', 'in.fechaIngreso', 'c.nomCliente', 'in.numComprobante', 'tc.nomTipoComprobante', 'tp.nomTipoPago', 'in.totalIngreso', 'u.nomUsuario', 'in.estado')
            ->join('cliente as c', 'in.idCliente', '=', 'c.idCliente')
        /* ->join('detalle_inscripcion as di', 'in.idIngreso', '=', 'di.idInscripcion') */
            ->join('tipo_comprobante as tc', 'in.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('tipopago as tp', 'in.idTipoPago', '=', 'tp.idTipoPago')
            ->join('usuario as u', 'in.idUsuario', '=', 'u.idUsuario')
            ->when(($request->get('startDate') != '' && $request->get('endDate') != ''), function ($query) use ($request) {
                $query->where('in.fechaIngreso', '>=', $request->get('startDate'))
                    ->where('in.fechaIngreso', '<=', $request->get('endDate'));
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
            ->where('in.fechaIngreso', '>=', $request->get('startDate'))
            ->where('in.fechaIngreso', '<=', $request->get('endDate'))
            ->where('tc.nomTipoComprobante', 'LIKE', '%' . $query . '%')
            ->where('in.idTipoIngreso', '=', $request->get('idTipoIngreso'))
            ->groupBy('in.idIngreso', 'in.idTipoIngreso', 'in.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'in.numComprobante', 'tp.nomTipoPago', 'in.totalIngreso', 'u.nomUsuario', 'in.estado')

            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);

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
    public function create(Request $request, $tipoIngreso)
    {

        Log::info("IngresosController/create()");
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        Log::info("IngresosController/create inciando");
        /* if ($request->ajax()) {
        $data = DB::table('paquetes')
        ->where('condicionPaquete', '=', '1')
        ->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->rawColumns([])
        ->make(true);
        } */
        switch ($tipoIngreso) {
            case '1':
                $productos = DB::table('producto')->where('condicionProducto', '=', '1')->get();
                return view('comercial/venta/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'productos' => $productos, 'usuario' => $usuario]);

                break;
            case '2':
                $paquetes = DB::table('paquetesgym')->where('condicionPaquete', '=', '1')->get();
                return view('comercial/inscripcion/create', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'paquetes' => $paquetes, 'usuario' => $usuario]);

                break;
            case '3':
                $paquetes = DB::table('paquetesgym')->where('condicionPaquete', '=', '1')->get();

                return view('contabilidad/ingresos/create', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario, 'paquetes' => $paquetes]);
                break;
        }

    }
    public function store(Request $request)
    {
        dump("LLEGUE STORE", $request->all());
        dump($request->fechaInicio);
        foreach ($request->fechaInicio as $key => $fecha) {
            dump($fecha);
            dump($request->idPaquete[$key]);
            dump($request->costoPaquete[$key]);
            //INSERT

        }
        $tipoIngreso = $request->get('idTipoIngreso');
        //dd($request, "LLEGUE MOVMIENTOS CONTROLLER");
        Log::info("IngresosController/store " . Utils::jsonLog($request->all()));
        $rules = array(
            'idCliente' => 'required',
            'idTipoPago' => 'required',
            'idTipoComprobante' => 'required',
            'idTipoIngreso' => 'required',
        );
        $messages = [
            'idCliente.required' => "Selecione cliente",
            'idTipoPago.required' => "Selecione tipo pago",
            'idTipoComprobante.required' => "Selecione comprabante",
            'idTipoIngreso' => "Indique tipo de Ingreso",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        //set fechas
        $fechaInicio = date('Y-m-d', strtotime(str_replace('/', '-', $request->fechaInicio))) . ' 00:00:00';
        $fechaFin = date('Y-m-d', strtotime(str_replace('/', '-', $request->fechaFin))) . ' 23:59:59';

        /* $estado = $this->estado_inscripcion($fechaInicio); */
        /*  Log::info("IngresosController/store estado_inscripcion => " . $estado); *///donde dice $tipoIngreso decia $estado para que sirve eso que me muestre STIVEN
        $insertIngreso = DB::table('ingreso')
            ->insertGetId([
                'idTipoIngreso' => $request->idTipoIngreso,
                'fechaIngreso' => $request->fechaIngreso,
                'idUsuario' => auth()->user()->obtener_usuario()->idUsuario,
                'idCliente' => $request->idCliente,
                'idTipoPago' => $request->idTipoPago,
                'idTipoComprobante' => $request->idTipoComprobante,
                'numComprobante' => $request->numeroComprobante, //aumentar input en la vista INSCRIPCION para ingresar este dato
                'descripcion' => $request->descripcion, //aumentar input auto rellenable en vista INSCRIPCION y VENTAS
                'totalIngreso' => $request->totalIngreso, // enviar el valor del input total para INSCRIPCION y VENTAS
                'estado' => 1,
            ]);
        //DESPUES DEL insertIngreso debe ir el STORE ASIENTOS para todos los tipos de INGRESOS o EGRESOS luego el insertDetalle y finalmente ya con los INGRESOS o EGRESOS que necesitan registrar más información en otras tablas

        switch ($tipoIngreso) {
            case '1':
                $productos = DB::table('producto')->where('condicionProducto', '=', '1')->get();
                return view('comercial/venta/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'productos' => $productos, 'usuario' => $usuario]);
/* $insertDetalleIngreso = DB::table('detalle_movimiento')->insertGetId([
'idIngreso' => $insertIngreso,
'idProducto' => $request->idPaquete, // Los paquetes serán productos entonces cambiar idPaquete por idProducto
'cantidad' => 1, // enviar este campo desde la vista INSCRIPION pq utilizaremos este controlador para INGRESOS y EGRESOS productos, servicios etc
//donde no se tenga cantidad pq es un servicio o cualquier otra cosa poner un input oculto CANTIDAD con valor 1 por default
'precioUnitario' => $request->costoPaquete, //cambiar el nombre de esta variable en INSCRIPCION por precioUnitario y que traiga el costo del paquete
]); */

                break;
            case '2':
                /* public function estado_inscripcion($fechaInicio)
                {
                $fechaActual = date('Y-m-d');
                $fechaInicio = date('Y-m-d', strtotime($fechaInicio));
                Log::info("InscripcionesController/estado_inscripcion comprar => fecha inicio " . $fechaInicio . ' y fecha actual  ' . $fechaActual);
                if ($fechaInicio > $fechaActual) {
                return 'ant';
                } else {
                return 'vig';
                }
                } */
                /// AQUI AGREGAR LINEA PARA QUE SALGA DEL SWITCH Y VAYA A LA RESPUESTA JSON ----- analizar bien el tema del estado de la inscripcion
                break;
            case '3':
                return response()->json([
                    "status" => 1,
                    "message" => "GuarDado correctamnte",
                    "data" => $insertIngreso,
                ]);

                return Redirect::to('contabilidad/asientos')->with(["status" => 1, "message" => "GuarDado correctamnte", "data" => $insertIngreso]);

                break;
        }

        return response()->json([
            "status" => 1,
            "message" => "GuarDado correctamnte",
            "data" => $insertIngreso,
        ]);
    }

    /* public function insertWebSocket($idCliente, $insertMovimiento, $fechaInicio, $fechaFin)
    {
    $socket = new Usuario();
    $cliente = DB::table('cliente')
    ->where('idCliente', $idCliente)
    ->first();
    $socket->store_cliente([
    'idInscripcion' => $insertInscripciones,
    'idCliente' => $cliente->idCliente,
    'docCliente' => $cliente->docCliente,
    'fechaInicio' => $fechaInicio,
    'fechaFin' => $fechaFin,
    'nomCliente' => $cliente->nomCliente,
    'fotoCliente' => $cliente->fotoCliente,
    ]);
    } */

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
