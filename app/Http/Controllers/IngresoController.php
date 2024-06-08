<?php

namespace App\Http\Controllers;

use App\Http\Controllers\IngresoController;
use App\Models\Cliente; //agrega la ruta del modelo
use App\Models\DetalleIngreso; //agrega la ruta del modelo
use App\Models\Ingreso; //para hacer algunas redirecciones
use App\Models\salida_producto_almacen; //hace referencia a nuestro request
use Barryvdh\DomPDF\Facade\Pdf; // sar la base de datos
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Luecano\NumeroALetras\NumeroALetras;
use stdClass;
use Validator;
use Yajra\DataTables\DataTables;

class IngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dataTable(Request $request)
    {
        $data = DB::table('ingresos as i')
            ->select(
                'i.idIngreso',
                DB::raw('DATE_FORMAT(i.created_at, "%d-%m-%Y") as created_at'),
                'c.nomCliente',
                'tc.nomTipoComprobante',
                'mp.nomMetodoPago',
                DB::raw('sum(dv.cantidadVenta*precioVenta) as total'),
                'i.idEstadoIngreso',
                'u.nomUsuario',
                'ei.nomEstado'
            )
            ->join('cliente as c', 'i.idCliente', '=', 'c.idCliente')
            ->join('detalle_venta as dv', 'i.idIngreso', '=', 'dv.idIngreso')
            ->join('estado_ingreso as ei', 'i.idEstadoIngreso', '=', 'ei.idEstadoIngreso')
            ->join('movimientos as m', 'm.idMovimiento', '=', 'i.idMovimiento')
            ->join('tipo_comprobante as tc', 'm.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('metodo_pago as mp', 'm.idMetodoPago', '=', 'mp.idMetodoPago')
            ->join('usuario as u', 'm.idUsuario', '=', 'u.idUsuario')
            ->when((date('Y-m-d', strtotime($request->get('IngresoDesde'))) != '') && (date('Y-m-d', strtotime($request->get('IngresoHasta'))) != ''), function ($query) use ($request) {
                $query->whereDate('m.created_at', '>=', date('Y-m-d', strtotime($request->get('IngresoDesde'))))
                    ->whereDate('m.created_at', '<=', date('Y-m-d', strtotime($request->get('IngresoHasta'))));
            })
            ->when(($request->get('idCliente') != '' && $request->get('idCliente') != 'null'), function ($query) use ($request) {
                $query->where('i.idCliente', '=', $request->get('idCliente'));
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
        //->toSql();
        //dd($data);
        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    public function index(Request $request)
    {
        $metodo_pago = DB::table('metodo_pago')
            ->join('asientos_frecuentes', 'asientos_frecuentes.idMetodoPago', 'metodo_pago.idMetodoPago')
            ->where('asientos_frecuentes.idTipoMovimiento', '1')
            ->where('condicionTipoPago', '=', '1')
            ->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        return view('comercial/venta/index', compact('metodo_pago', 'tipo_comprobante', 'usuario'));
    }
    public function pdf(Request $request, $id)
    {
        $ingreso = DB::table('ingresos as i')
            ->select('i.idIngreso', 'i.created_at', 'i.idCliente', 'c.nomCliente', 'tc.nomTipoComprobante', 'tp.nomMetodoPago', DB::raw('sum(dv.cantidadVenta* dv.precioVenta) as total'), 'u.nomUsuario', 'i.idEstadoIngreso')
            ->join('cliente as c', 'i.idCliente', '=', 'c.idCliente')
            ->join('detalle_venta as dv', 'i.idIngreso', '=', 'dv.idIngreso')
            ->join('movimientos as m', 'm.idMovimiento', '=', 'i.idMovimiento')
            ->join('tipo_comprobante as tc', 'm.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('metodo_pago as tp', 'm.idMetodoPago', '=', 'tp.idMetodoPago')
            ->join('usuario as u', 'm.idUsuario', '=', 'u.idUsuario')
            ->where('i.idIngreso', '=', $id)
            ->first();
        $detalle = DB::table('detalle_venta as dv')
            ->select('dv.idProducto', 'pro.nomProducto', 'dv.cantidadVenta', 'dv.precioVenta', DB::raw('dv.cantidadVenta*dv.precioVenta as subtotal'))
            ->join('producto as pro', 'dv.idProducto', '=', 'pro.idProducto')
            ->join('ingresos as i', 'i.idIngreso', '=', 'dv.idIngreso')
            ->where('dv.idIngreso', '=', $id)
            ->groupBy('dv.idProducto')
            ->get();
        $infoNego = DB::table('info_negocio')->first();
        $formatter = new NumeroALetras();
        $literal = $formatter->toInvoice($ingreso->total, 2, 'BOLIVIANOS');

        $pdf = Pdf::setPaper([0, 0, 226.77, 2267.72])->loadView('comercial.venta.venta-pdf', ['ingreso' => $ingreso, 'detalle' => $detalle, 'infoNego' => $infoNego, 'literal' => $literal]);

        return response()->json([
            'data' => base64_encode($pdf->output()),
        ]);
    }
    public function create(Request $request)
    {
        $metodo_pago = DB::table('metodo_pago')
            ->join('asientos_frecuentes', 'asientos_frecuentes.idMetodoPago', 'metodo_pago.idMetodoPago')
            ->where('asientos_frecuentes.idTipoMovimiento', '1')
            ->where('condicionTipoPago', '=', '1')
            ->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $estado_ingreso = DB::table('estado_ingreso')->where('condicionEstado', '=', '1')->get();

        return view('comercial/venta/create', compact('tipo_comprobante', 'metodo_pago', 'estado_ingreso'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'idCliente' => 'required',
            'idMetodoPago' => 'required',
            'idTipoComprobante' => 'required',
            'detalleVenta' => 'required',
        );
        $messages = [
            'idCliente.required' => "Seleccione cliente",
            'idMetodoPago.required' => "Seleccione metodo de pago",
            'idTipoComprobante.required' => "Seleccione Tipo comprobante",
            'detalleVenta.required' => "Seleccione productos",
        ];
        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
                'data' => [
                    'error' => [],
                ],
            ]);
        }
        $validate = $this->validateArray($request);
        if ($validate) {
            return response()->json([
                'status' => 0,
                'message' => ['Las series en los productos son obligatorias'],
                'data' => [
                    'error' => [],
                ],
            ]);
        }

        $series = [];
        foreach ($request->detalleVenta as $key => $producto) {
            $series[] = $producto['serie'];
        }
        //verificando series salida
        $verificandoSalida = DB::table('salida_producto_almacen')
            ->select(
                'salida_producto_almacen.*'
            )
            ->whereIn('serie', $series)
            ->get();
        if (count($verificandoSalida) > 0) {
            return response()->json([
                'status' => 0,
                'message' => ['Las siguentes series ya fueron registradas'],
                'data' => [
                    'error' => $verificandoSalida,
                ],
            ]);
        }

        //verificando series entrada
        $verificandoEntrada = DB::table('entrada_producto_almacen')
            ->select(
                'entrada_producto_almacen.*'
            )
            ->whereIn('serie', $series)
            ->get();
        $collection = $this->ArrayToColleccion($request->detalleVenta);

        $errorSeries = $this->filtrarArrayObject($collection, $verificandoEntrada);
        if (count($errorSeries) > 0) {
            return response()->json([
                "status" => 0,
                "message" => 'series no entregados',
                'data' => [
                    'error' => $errorSeries,
                ],
            ]);
        }

        $totalMovimiento = $this->calculo_total($request);
        $insertMovimiento = DB::table('movimientos')
            ->insertGetId([
                'idTipoMovimiento' => 1,
                'idUsuario' => auth()->user()->obtener_usuario()->idUsuario,
                'descripcion' => $this->crear_glosa($request),
                'totalMov' => $totalMovimiento,
                'idProyecto' => 1,
                'idMetodoPago' => $request->idMetodoPago,
                'idTipoComprobante' => $request->idTipoComprobante,
                'numComprobante' => date('dmY') . '-' . date('Hms'),
                'razon_social' => $this->crear_recibir_entregar($request),
            ]);
        //agrupacion
        $insertVenta = DB::table('ingresos')
            ->insertGetId([
                'idMovimiento' => $insertMovimiento,
                'idTipoIngreso' => 1,
                'idCliente' => $request->idCliente,
                'idEstadoIngreso' => $request->idEstadoIngreso,
            ]);

        $productos = $this->agrupar_productos($request);

        foreach ($productos as $key => $value) {
            $insertDetalleVenta = DB::table('detalle_venta')
                ->insertGetId([
                    'idIngreso' => $insertVenta,
                    'idProducto' => $value->idProducto,
                    'cantidadVenta' => $value->cantidad,
                    'precioVenta' => $value->precio,
                ]);
            //series
            foreach ($collection as $key => $data) {
                if ($data->idProducto == $value->idProducto) {
                    salida_producto_almacen::insert([
                        'serie' => $data->serie,
                        'idProducto' => $data->idProducto,
                        'detalle_venta_id' => $insertDetalleVenta,
                        'idAlmacen' => 0,
                    ]);
                }
            }
        }
        //generar asientos si se pago la venta
        if ($request->idEstadoIngreso == 2) {
            $generar_asiento = $this->generar_asiento($request->idMetodoPago, $insertMovimiento, $totalMovimiento, $request);
        }

        return response()->json([
            "status" => 1,
            "message" => "Registrado correctamnte",
            "data" => [
                'insertVenta' => $insertVenta,
                'error' => $errorSeries,
            ],
        ]);
    }

    public function comparar($series, $entradas)
    {
        foreach ($series as $key => $serie) {

        }
    }
    public function calculo_total(Request $request)
    {
        $total = 0;
        foreach ($request->detalleVenta as $key => $value) {
            $total += intval($value['precio']);
        }
        return $total;
    }

    private function crear_glosa(Request $request)
    {
        $glosa = 'concepto de venta: ';
        foreach ($request->detalleVenta as $key => $value) {
            $glosa .= 'Prod:' . $value['nomProducto'] . ' Cod:' . $value['idProducto'] . ' Cant:' . count($request->detalleVenta) . ' Precio:' . $value['precio'] . PHP_EOL;
        }
        return $glosa;
    }
    private function crear_recibir_entregar(Request $request)
    {
        $cliente = DB::table('cliente')->where('cliente.idCliente', $request->idCliente)->first();
        return 'Venta para cliente ' . $cliente->nomCliente;
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
    public function agrupar_productos(Request $request)
    {
        $resultado = array();
        $productos = array();

        foreach ($request->detalleVenta as $k => $producto) {
            $idProducto = $producto["idProducto"];
            //unset($producto['idProducto']);
            $productos[$idProducto][] = $producto;
        }
        //agrupamientos
        foreach ($productos as $key => $producto) {
            $valor = new stdClass;
            $valor->cantidad = count($producto);
            foreach ($producto as $key => $data) {
                $valor->idProducto = $data['idProducto'];
                $valor->precio = $data['precio'];
            }
            $resultado[] = $valor;
        }
        return $resultado;
    }

    public function validateArray(Request $request)
    {
        $error = false;
        foreach ($request->detalleVenta as $k => $producto) {
            if ($producto["serie"] == '') {
                $error = true;
                break;
            }
        }
        return $error;
    }
    public function filtrarArrayObject($array, $arrayFiltro)
    {
        $resultado = [];
        foreach ($array as $key => $valor) {
            $bandera = false;
            foreach ($arrayFiltro as $key => $filtro) {
                if ($valor->serie == $filtro->serie) {
                    $bandera = true;
                    break;
                }
            }
            if (!$bandera) {
                $resultado[] = $valor;
            }
        }
        return $resultado;
    }
    public function ArrayToColleccion($items)
    {
        $collection = new Collection();
        foreach ($items as $item) {
            $collection->push((object) $item);
        }
        return $collection;
    }
}
