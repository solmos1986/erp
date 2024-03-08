<?php

namespace App\Http\Controllers;

use App\Http\Controllers\IngresoController;
use App\Models\Cliente; //agrega la ruta del modelo
use App\Models\DetalleIngreso; //agrega la ruta del modelo
use App\Models\Ingreso; //para hacer algunas redirecciones
use App\Models\salida_producto_almacen;
use DB; //hace referencia a nuestro request
use Illuminate\Http\Request; // sar la base de datos
use Yajra\DataTables\DataTables;

class IngresoController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
        //dd($request, "ESTO ESTA LLEGANDO");
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        $query = trim($request->get('searchText'));
        if ($request->ajax()) {
            $data = DB::table('ingresos as i')
                ->select('i.idIngreso', 'i.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', 'tp.nomTipoPago', DB::raw('sum(di.cantidadVenta*precioVenta) as total'), 'i.estadoIngreso', 'u.nomUsuario')
                ->join('cliente as c', 'i.idCliente', '=', 'c.idCliente')
                ->join('detalle_ingreso as di', 'i.idIngreso', '=', 'di.idIngreso')
                ->join('tipo_comprobante as tc', 'i.idTipoComprobante', '=', 'tc.idTipoComprobante')
                ->join('tipopago as tp', 'i.idTipoPago', '=', 'tp.idTipoPago')
                ->join('usuario as u', 'i.idUsuario', '=', 'u.idUsuario')
                ->when(($request->get('startDate') != '' && $request->get('endDate') != ''), function ($query) use ($request) {
                    $query->where('i.fechaIngreso', '>=', $request->get('startDate'))
                        ->where('i.fechaIngreso', '<=', $request->get('endDate'));
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
                ->where('i.fechaIngreso', '>=', $request->get('startDate'))
                ->where('i.fechaIngreso', '<=', $request->get('endDate'))
                ->groupBy('i.idIngreso', 'i.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', 'tp.nomTipoPago', 'u.nomUsuario', 'i.estadoIngreso')
                ->get()->toArray();

            /*   } */
            //dd($data);

            /*   $data->where('i.idUsuario', '=', $request->get('idUsuario'))
            ->where('tc.nomTipoComprobante', 'LIKE', '%' . $query . '%')

            ->groupBy('i.idIngreso', 'i.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', 'tp.nomTipoPago', 'u.nomUsuario', 'i.estadoIngreso')
            ->get(); */
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('comercial/venta/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);

    }
    public function create(Request $request)
    {
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        if ($request->ajax()) {
            $data = DB::table('producto')
                ->where('condicionProducto', '=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }

        return view('comercial/venta/create', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante]);

    }
    public function store(Request $request)
    {
        //dd($request->detalleVenta, "LLEGUE STORE");
        $insertVenta = DB::table('ingresos')
            ->insertGetId([
                'idCliente' => $request->idCliente,
                'idTipoPago' => $request->idTipoPago,
                'idTipoComprobante' => $request->idTipoComprobante,
                'fechaIngreso' => $request->fechaIngreso,
                'impuestoIngreso' => $request->impuestoIngreso,
                'estadoIngreso' => $request->estadoIngreso,
                'idUsuario' => $request->idUsuario,
            ]);

        foreach ($request->detalleVenta as $key => $value) {
            /* dump($value['idProducto']); */
            $insertDetalleVenta = DB::table('detalle_ingreso')
                ->insertGetId([
                    'idIngreso' => $insertVenta,
                    'idProducto' => $value['idProducto'],
                    'cantidadVenta' => $value['cantidad'],
                    'precioVenta' => $value['precioVentaProducto'],

                ]);

            $datos = [];
            for ($i = 1; $i <= $value['cantidad']; $i++) {
                //dump($i);
                //dd($value['cantidad']);
                array_push($datos, array(
                    'serie' => 'serie',
                    'idProducto' => $value['idProducto'],
                    'idDetalleIngreso' => $insertDetalleVenta,
                ));
                /*   $datos = array(
            'serie' => 'serie',
            'producto_id' => $value['idProducto'],
            'idDetalleEgreso' => $insertDetalleCompra,
            ); */
            }
            // dump(count($datos));

        }
        //dd('stop');

        salida_producto_almacen::insert($datos);

        return response()->json([
            "status" => 1,
            "message" => "GuarDado correctamnte",
            "data" => null,
        ]);
    }
    /* public function filter(Request $request)
    {
    $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
    $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
    $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
    $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
    $query = trim($request->get('searchText'));
    $data = DB::table('ingresos as i')
    ->join('cliente as c', 'i.idCliente', '=', 'c.idCliente')
    ->join('detalle_ingreso as di', 'i.idIngreso', '=', 'di.idIngreso')
    ->join('tipo_comprobante as tc', 'i.idTipoComprobante', '=', 'tc.idTipoComprobante')
    ->join('tipopago as tp', 'i.idTipoPago', '=', 'tp.idTipoPago')
    ->join('usuario as u', 'i.idUsuario', '=', 'u.idUsuario')
    ->select('i.idIngreso', 'i.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', 'tp.nomTipoPago', DB::raw('sum(di.cantidadVenta*precioVenta) as total'), 'i.estadoIngreso', 'u.nomUsuario')
    ->where('tc.nomTipoComprobante', 'LIKE', '%' . $query . '%')

    ->groupBy('i.idIngreso', 'i.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', 'tp.nomTipoPago', 'u.nomUsuario', 'i.estadoIngreso')
    ->get();
    return Datatables::of($data)
    ->addIndexColumn()
    ->rawColumns([])
    ->make(true);

    } */
    public function edit()
    {

    }
}
