<?php

namespace App\Http\Controllers;

use App\Http\Controllers\IngresoController;
use App\Models\Cliente; //agrega la ruta del modelo
use App\Models\DetalleIngreso; //agrega la ruta del modelo
use App\Models\Ingreso; //para hacer algunas redirecciones
use App\Models\salida_producto_almacen;
use Barryvdh\DomPDF\Facade\Pdf; //hace referencia a nuestro request
use DB; // sar la base de datos
use Illuminate\Http\Request;
use Luecano\NumeroALetras\NumeroALetras;
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
                DB::raw('DATE_FORMAT(i.fechaIngreso, "%d-%m-%Y") as fechaIngreso'),
                'c.nomCliente',
                'tc.nomTipoComprobante',
                'i.impuestoIngreso',
                'tp.nomTipoPago',
                DB::raw('sum(di.cantidadVenta*precioVenta) as total'),
                'i.estadoIngreso',
                'u.nomUsuario'
            )
            ->join('cliente as c', 'i.idCliente', '=', 'c.idCliente')
            ->join('detalle_ingreso as di', 'i.idIngreso', '=', 'di.idIngreso')
            ->join('tipo_comprobante as tc', 'i.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('tipopago as tp', 'i.idTipoPago', '=', 'tp.idTipoPago')
            ->join('usuario as u', 'i.idUsuario', '=', 'u.idUsuario')
            ->when((date('Y-m-d', strtotime($request->get('IngresoDesde'))) != '') && (date('Y-m-d', strtotime($request->get('IngresoHasta'))) != ''), function ($query) use ($request) {
                $query->where('i.fechaIngreso', '>=', date('Y-m-d', strtotime($request->get('IngresoDesde'))))
                    ->where('i.fechaIngreso', '<=', date('Y-m-d', strtotime($request->get('IngresoHasta'))));
            })
            ->when(($request->get('idCliente') != ''), function ($query) use ($request) {
                $query->where('i.idCliente', '=', $request->get('idCliente'));
            })
            ->when(($request->get('idTipoComprobante') != ''), function ($query) use ($request) {
                $query->where('i.idTipoComprobante', '=', $request->get('idTipoComprobante'));
            })
            ->when(($request->get('idTipoPago') != ''), function ($query) use ($request) {
                $query->where('i.idTipoPago', '=', $request->get('idTipoPago'));

            })
            ->when(($request->get('idUsuario') != ''), function ($query) use ($request) {
                $query->where('i.idUsuario', '=', $request->get('idUsuario'));
            })
            ->groupBy('i.idIngreso', 'i.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', 'tp.nomTipoPago', 'u.nomUsuario', 'i.estadoIngreso')
            ->get()->toArray();

        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    public function index(Request $request)
    {
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        $query = trim($request->get('searchText'));
        return view('comercial/venta/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);
    }
    public function pdf(Request $request, $id)
    {
        $ingreso = DB::table('ingresos as i')
            ->select('i.idIngreso', 'i.fechaIngreso', 'i.idCliente', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', 'tp.nomTipoPago', DB::raw('sum(di.cantidadVenta*precioVenta) as total'), 'u.nomUsuario', 'i.estadoIngreso')
            ->join('cliente as c', 'i.idCliente', '=', 'c.idCliente')
            ->join('detalle_ingreso as di', 'i.idIngreso', '=', 'di.idIngreso')
            ->join('tipo_comprobante as tc', 'i.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('tipopago as tp', 'i.idTipoPago', '=', 'tp.idTipoPago')
            ->join('usuario as u', 'i.idUsuario', '=', 'u.idUsuario')
            ->where('i.idIngreso', '=', $id)
            ->first();
        $detalle = DB::table('detalle_ingreso as di')
            ->select('di.idProducto', 'pro.nomProducto', 'di.cantidadVenta', 'di.precioVenta', DB::raw('di.cantidadVenta*precioVenta as subtotal'))
            ->join('producto as pro', 'di.idProducto', '=', 'pro.idProducto')
            ->join('ingresos as i', 'i.idIngreso', '=', 'di.idIngreso')
            ->where('di.idIngreso', '=', $id)
            ->groupBy('di.idProducto')
            ->get();
        $infoNego = DB::table('info_negocio')->first();
        $formatter = new NumeroALetras();
        $literal = $formatter->toInvoice($ingreso->total, 2, 'BOLIVIANOS');
        //dd($ingreso, "DD INGRESO");

        $pdf = Pdf::setPaper([0, 0, 226.77, 2267.72])->loadView('comercial.venta.venta-pdf', ['ingreso' => $ingreso, 'detalle' => $detalle, 'infoNego' => $infoNego, 'literal' => $literal]);

        return response()->json([
            'data' => base64_encode($pdf->output()),
        ]);
    }
    public function create(Request $request)
    {
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();

        if ($request->ajax()) {
            $data = DB::table('producto')
                ->where('condicionProducto', '=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }
        return view('comercial/venta/create', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);
    }
    public function store(Request $request)
    {
        $insertVenta = DB::table('ingresos')
            ->insertGetId([
                'idCliente' => $request->idCliente,
                'idTipoPago' => $request->idTipoPago,
                'idTipoComprobante' => $request->idTipoComprobante,
                'fechaIngreso' => $request->fechaIngreso,
                'impuestoIngreso' => $request->impuestoIngreso,
                'estadoIngreso' => $request->estadoIngreso,
                'idUsuario' => auth()->user()->obtener_usuario()->idUsuario,
            ]);

        $datos = [];
        foreach ($request->detalleVenta as $key => $value) {
            $insertDetalleVenta = DB::table('detalle_ingreso')
                ->insertGetId([
                    'idIngreso' => $insertVenta,
                    'idProducto' => $value['idProducto'],
                    'cantidadVenta' => $value['cantidad'],
                    'precioVenta' => $value['precio'],
                ]);

            for ($i = 1; $i <= $value['cantidad']; $i++) {
                array_push($datos, array(
                    'serie' => 'serie',
                    'idProducto' => $value['idProducto'],
                    'idDetalleIngreso' => $insertDetalleVenta,
                ));
            }
        }
        salida_producto_almacen::insert($datos);
        return response()->json([
            "status" => 1,
            "message" => "GuarDado correctamnte",
            "data" => $insertVenta,
        ]);
    }

    public function edit()
    {

    }
}
