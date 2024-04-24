<?php

namespace App\Http\Controllers;

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
        $data = DB::table('ingresos as in')
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
        $cuenta = db::table('cuenta')->where('condicion', '=', '1')->get();
        $ingresoTipo = DB::table('tipoingresos')->where('condicion', '=', '1')->get();
        Log::info("IngresosController/create inciando");
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

                return view('contabilidad/ingresos/create', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario, 'cuenta' => $cuenta, 'ingresoTipo' => $ingresoTipo]);
                break;
        }

    }
    public function store(Request $request)
    {
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

        //dd("LLEGUE STORE", $request->all());
        //dump($request->fechaInicio);
        $insertMovimiento = DB::table('movimientos')
            ->insertGetId([
                'idTipoMov' => $request->idTipoMov,
                'fechaMov' => $request->fechaIngreso,
                'idUsuario' => auth()->user()->obtener_usuario()->idUsuario,
                'descripcion' => $request->descripcion,
                'totalMov' => $request->totalIngreso,
                'idProyecto' => 1, //crear tabla Proyectos y la oficina central es 1
            ]);

        foreach ($request->cuenta_id as $key => $cuenta) {
            $insertAsiento = DB::table('asientos')
                ->insertGetId([
                    'idMovimiento' => $insertMovimiento,
                    'idCuenta' => $cuenta,
                    'debe' => $request->debe[$key],
                    'haber' => $request->haber[$key],
                ]);
        }
//INSERT
        $insertIngreso = DB::table('ingresos')
            ->insertGetId([
                'idTipoIngreso' => $request->idTipoIngreso,
                'idMovimiento' => $insertMovimiento,
                'fechaIngreso' => $request->fechaIngreso,
                'idUsuario' => auth()->user()->obtener_usuario()->idUsuario,
                'idCliente' => $request->idCliente,
                'idMetodoPago' => $request->idTipoPago,
                'idTipoComprobante' => $request->idTipoComprobante,
                'numComprobante' => $request->numComprobante, //aumentar input en la vista INSCRIPCION para ingresar este dato
                'totalIngreso' => $request->totalIngreso, // enviar el valor del input total para INSCRIPCION y VENTAS
                'estado' => 1,
            ]);
        dd("Acabo Mov,Asiento e Ingreso", $request->all());
        $tipoIngreso = $request->get('idTipoIngreso');
        switch ($tipoIngreso) {
            case '1':
                //Si idTipoIngreso=1 es una Venta de Productos
                $datos = [];
                foreach ($request->idProducto as $key => $producto) {
                    $insertDetalleVenta = DB::table('detalle_venta')->insertGetId([
                        'idIngreso' => $insertIngreso,
                        'idProducto' => $producto, // Los paquetes serán productos entonces cambiar idPaquete por idProducto
                        'cantidadVenta' => $request->cantidad[$key],
                        'precioVenta' => $request->precio[$key],
                    ]);
                    for ($i = 1; $i <= $value['cantidad']; $i++) {
                        array_push($datos, array(
                            'serie' => 'serie',
                            'idProducto' => $value['idProducto'],
                            'idDetalleIngreso' => $insertDetalleVenta,
                        ));
                    }
                    salida_producto_almacen::insert($datos);

                }
                break;
            case '2':
                //Si idTipoIngreso = 2 es una INSCRIPCION
                //set fechas
                $fechaInicio = date('Y-m-d', strtotime(str_replace('/', '-', $request->fechaInicio))) . ' 00:00:00';
                $fechaFin = date('Y-m-d', strtotime(str_replace('/', '-', $request->fechaFin))) . ' 23:59:59';

                $estado = $this->estado_inscripcion($fechaInicio);
                Log::info("IngresosController/store estado_inscripcion => " . $estado);

                $insertDetalleInscripcion = DB::table('detalle_inscripcion')->insertGetId([
                    'idIngreso' => $insertIngreso,
                    'idCliente' => $request->idCliente,
                    'idPaquete' => $request->idPaquete,
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin,
                    'costoPaquete' => $request->costoPaquete,
                    'estadoInscripcion' => $estado,
                    'idUsuario' => auth()->user()->obtener_usuario()->idUsuario,
                    'condicion' => 1,
                ]);

                if ($estado == 'vig') {
                    Log::info("IngresosController/store activando socket por el estado => " . $estado);
                    $this->insertWebSocket($request->idCliente, $insertDetalleInscripcion, $fechaInicio, $fechaFin);
                }
                break;
            case '3':
                //Si idTipoIngreso = 3 es un INGRESO VARIOS

                break;
        }
        return response()->json([
            "status" => 1,
            "message" => "GuarDado correctamnte",
            "data" => $insertIngreso,
        ]);

    }
    public function estado_inscripcion($fechaInicio)
    {

        $fechaActual = date('Y-m-d');
        $fechaInicio = date('Y-m-d', strtotime($fechaInicio));
        Log::info("InscripcionesController/estado_inscripcion comprar => fecha inicio " . $fechaInicio . ' y fecha actual  ' . $fechaActual);
        if ($fechaInicio > $fechaActual) {
            return 'ant';
        } else {
            return 'vig';
        }
    }
    public function insertWebSocket($idCliente, $insertDetalleInscripcion, $fechaInicio, $fechaFin)
    {
        $socket = new Usuario();
        $cliente = DB::table('cliente')
            ->where('idCliente', $idCliente)
            ->first();
        $socket->store_cliente([
            'idInscripcion' => $insertDetalleInscripcion,
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
