<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EgresoController;
use App\Models\DetalleEgreso; //agrega la ruta del modelo
use App\Models\Egreso; //agrega la ruta del modelo
use App\Models\entrada_producto_almacen; //para hacer algunas redirecciones
use App\Models\Proveedor; //hace referencia a nuestro request
use Barryvdh\DomPDF\Facade\Pdf; // sar la base de datos
use DB;
use Illuminate\Http\Request;
use Luecano\NumeroALetras\NumeroALetras;
use Validator;
use Yajra\DataTables\DataTables;

class EgresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $proveedores = DB::table('proveedor')->where('condicionProveedor', '=', '1')->get();
        $tipopago = DB::table('metodo_pago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        return view('comercial/compra/index', compact('proveedores', 'tipopago', 'tipo_comprobante', 'usuario'));
    }

    public function dataTable(Request $request)
    {
        //dd(date('Y-m-d', strtotime($request->get('startDate'))));
        $data = DB::table('egresos as e')
            ->select(
                'e.idEgreso',
                DB::raw('DATE_FORMAT(e.created_at, "%d-%m-%Y") as created_at'),
                'p.nomProveedor',
                'tc.nomTipoComprobante',
                'm.numComprobante',
                'mp.nomMetodoPago',
                DB::raw('sum(dc.cantidadCompra*dc.precioCompra) as total'),
                'u.nomUsuario',
                'e.idEstadoEgreso',
                'estado_egreso.nomEstado')
            ->join('proveedor as p', 'e.idProveedor', '=', 'p.idProveedor')
            ->join('detalle_compra as dc', 'e.idEgreso', '=', 'dc.idEgreso')
            ->join('estado_egreso', 'estado_egreso.idEstadoEgreso', 'e.idEstadoEgreso')
            ->join('movimientos as m', 'm.idMovimiento', '=', 'e.idMovimiento')
            ->join('tipo_comprobante as tc', 'm.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('metodo_pago as mp', 'm.idMetodoPago', '=', 'mp.idMetodoPago')
            ->join('usuario as u', 'm.idUsuario', '=', 'u.idUsuario')
            ->when((date('Y-m-d', strtotime($request->get('startDate'))) != '' && date('Y-m-d', strtotime($request->get('endDate'))) != ''), function ($query) use ($request) {
                $query->whereDate('e.created_at', '>=', date('Y-m-d', strtotime($request->get('startDate'))))
                    ->whereDate('e.created_at', '<=', date('Y-m-d', strtotime($request->get('endDate'))));
            })
            ->when(($request->get('idProveedor') != ''), function ($query) use ($request) {
                $query->where('e.idProveedor', '=', $request->get('idProveedor'));
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
            ->groupBy('m.idMovimiento')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    public function pdf(Request $request, $id)
    {
        $egreso = DB::table('egresos as e')
            ->select('e.idEgreso', 'e.created_at', 'e.idProveedor', 'p.nomProveedor', 'tc.nomTipoComprobante', 'm.numComprobante', 'mp.nomMetodoPago', DB::raw('sum(dc.cantidadCompra*dc.precioCompra) as total'), 'u.nomUsuario', 'e.idEstadoEgreso')
            ->join('proveedor as p', 'e.idProveedor', '=', 'p.idProveedor')
            ->join('detalle_compra as dc', 'e.idEgreso', '=', 'dc.idEgreso')
            ->join('movimientos as m', 'm.idMovimiento', '=', 'e.idMovimiento')
            ->join('tipo_comprobante as tc', 'm.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('metodo_pago as mp', 'm.idMetodoPago', '=', 'mp.idMetodoPago')
            ->join('usuario as u', 'm.idUsuario', '=', 'u.idUsuario')
            ->where('e.idEgreso', '=', $id)
            ->first();
        $detalle = DB::table('detalle_compra as dc')
            ->select('dc.idProducto', 'pro.nomProducto', 'dc.cantidadCompra', 'dc.precioCompra', DB::raw('dc.cantidadCompra*dc.precioCompra as subtotal'))
            ->join('producto as pro', 'dc.idProducto', '=', 'pro.idProducto')
            ->join('egresos as e', 'e.idEgreso', '=', 'dc.idEgreso')
            ->where('dc.idEgreso', '=', $id)
            ->groupBy('dc.idProducto')
            ->get();
        $infoNego = DB::table('info_negocio')->first();
        $formatter = new NumeroALetras();
        $literal = $formatter->toInvoice($egreso->total, 2, 'BOLIVIANOS');
        //dd($literal);

        $pdf = Pdf::setPaper([0, 0, 226.77, 2267.72])->loadView('comercial.compra.compra-pdf', ['egreso' => $egreso, 'detalle' => $detalle, 'infoNego' => $infoNego, 'literal' => $literal]);

        return response()->json([
            'data' => base64_encode($pdf->output()),
        ]);

    }
    public function create(Request $request)
    {
        $proveedor = DB::table('proveedor')->where('condicionProveedor', '=', '1')->get();
        $metodoPago = DB::table('metodo_pago')
            ->join('asientos_frecuentes', 'asientos_frecuentes.idMetodoPago', 'metodo_pago.idMetodoPago')
            ->where('asientos_frecuentes.idTipoMovimiento', '2')
            ->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        $estado_egreso = DB::table('estado_egreso')->where('condicionEstado', '=', '1')->get();
        $categoria = DB::table('categoria')->where('condicionCategoria', '=', '1')->get();
        $unidad_medida = DB::table('unidad_medida')->get();
        return view('comercial/compra/create', compact('proveedor', 'metodoPago', 'tipo_comprobante', 'usuario', 'categoria', 'estado_egreso', 'unidad_medida'));
    }

    public function edit($id)
    {
        return view('comercial/compra/edit');
    }
    public function store(Request $request)
    {
        $rules = array(
            'idProveedor' => 'required',
            'idMetodoPago' => 'required',
            'idTipoComprobante' => 'required',
        );
        $messages = [
            'idProveedor.required' => "Seleccione proveedor",
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
        $totalMovimiento = $this->calculo_total($request);
        $insertMovimiento = DB::table('movimientos')
            ->insertGetId([
                'idTipoMovimiento' => 2,
                'idUsuario' => auth()->user()->obtener_usuario()->idUsuario,
                'descripcion' => $this->crear_glosa($request),
                'totalMov' => $totalMovimiento,
                'idProyecto' => 1,
                'idMetodoPago' => $request->idMetodoPago,
                'idTipoComprobante' => $request->idTipoComprobante,
                'numComprobante' => date('dmY') . '-' . date('Hms'),
                'razon_social' => $this->crear_recibir_entregar($request),
            ]);
        $insertCompra = DB::table('egresos')
            ->insertGetId([
                'idMovimiento' => $insertMovimiento,
                'idTipoEgreso' => 1,
                'idProveedor' => $request->idProveedor,
                'idEstadoEgreso' => $request->idEstadoEgreso,
            ]);

        $datos = [];
        foreach ($request->detallecompra as $key => $value) {
            $insertDetalleCompra = DB::table('detalle_compra')
                ->insertGetId([
                    'idEgreso' => $insertCompra,
                    'idProducto' => $value['idProducto'],
                    'cantidadCompra' => $value['cantidad'],
                    'precioCompra' => $value['precio'],
                ]);
        }
        //generar asientos si se pago el compra
        if ($request->idEstadoEgreso == 2) {
            $generar_asiento = $this->generar_asiento($request->idMetodoPago, $insertMovimiento, $totalMovimiento, $request);
        }

        //entrada_producto_almacen::insert($datos);
        return response()->json([
            "status" => 1,
            "message" => "Registrado correctamnte",
            "data" => $insertCompra,
        ]);
    }

    public function calculo_total(Request $request)
    {
        $total = 0;
        foreach ($request->detallecompra as $key => $value) {
            $total += intval($value['cantidad']) * intval($value['precio']);
        }
        return $total;
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
    private function crear_glosa(Request $request)
    {
        $glosa = 'concepto de compra: ';
        foreach ($request->detallecompra as $key => $value) {
            $glosa .= 'Prod:' . $value['nomProducto'] . ' Cod:' . $value['idProducto'] . ' Cant:' . $value['cantidad'] . ' Precio:' . $value['precio'] . PHP_EOL;
        }
        return $glosa;
    }
    private function crear_recibir_entregar(Request $request)
    {
        $proveedor = DB::table('proveedor')->where('proveedor.idProveedor', $request->idProveedor)->first();
        return 'Compra a ' . $proveedor->nomProveedor;
    }
}
