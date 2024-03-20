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
use Yajra\DataTables\DataTables;

class EgresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
        //dd($request, "ESTO ESTA LLEGANDO");
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();

        if ($request->ajax()) {
            $query = trim($request->get('searchText'));
            $data = DB::table('egresos as e')
                ->select('e.idEgreso', 'e.fechaEgreso', 'p.nomProveedor', 'tc.nomTipoComprobante', 'e.numeroComprobante', 'e.impuestoEgreso', 'tp.nomTipoPago', DB::raw('sum(de.cantidadCompra*precioCompraEgreso) as total'), 'u.nomUsuario', 'e.estadoEgreso')
                ->join('proveedor as p', 'e.idProveedor', '=', 'p.idProveedor')
                ->join('detalle_egreso as de', 'e.idEgreso', '=', 'de.idEgreso')
                ->join('tipo_comprobante as tc', 'e.idTipoComprobante', '=', 'tc.idTipoComprobante')
                ->join('tipopago as tp', 'e.idTipoPago', '=', 'tp.idTipoPago')
                ->join('usuario as u', 'e.idUsuario', '=', 'u.idUsuario')
                ->when(($request->get('startDate') != '' && $request->get('endDate') != ''), function ($query) use ($request) {
                    $query->where('e.fechaEgreso', '>=', $request->get('startDate'))
                        ->where('e.fechaEgreso', '<=', $request->get('endDate'));
                })
                ->when(($request->get('idCliente') != ''), function ($query) use ($request) {
                    $query->where('e.idCliente', '=', $request->get('idCliente'));

                })
                ->when(($request->get('idTipoComprobante') != ''), function ($query) use ($request) {
                    $query->where('e.idTipoComprobante', '=', $request->get('idTipoComprobante'));

                })
                ->when(($request->get('idTipoPago') != ''), function ($query) use ($request) {
                    $query->where('e.idTipoPago', '=', $request->get('idTipoPago'));

                })
                ->when(($request->get('idUsuario') != ''), function ($query) use ($request) {
                    $query->where('e.idUsuario', '=', $request->get('idUsuario'));

                })
                ->where('e.fechaEgreso', '>=', $request->get('startDate'))
                ->where('e.fechaEgreso', '<=', $request->get('endDate'))
                ->where('e.numeroComprobante', 'LIKE', '%' . $query . '%')
                ->groupBy('e.idEgreso', 'e.fechaEgreso', 'p.nomProveedor', 'tc.nomTipoComprobante', 'e.numeroComprobante', 'e.impuestoEgreso', 'tp.nomTipoPago', 'u.nomUsuario', 'e.estadoEgreso')
                ->get();
            /*   dd($data,"HOLAAA"); */
            /* return view('comercial.compra.index',compact('data')); */
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('comercial/compra/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);
    }
    public function pdf(Request $request, $id)
    {
        $egreso = DB::table('egresos as e')
            ->select('e.idEgreso', 'e.fechaEgreso', 'e.idProveedor', 'p.nomProveedor', 'tc.nomTipoComprobante', 'e.numeroComprobante', 'e.impuestoEgreso', 'tp.nomTipoPago', DB::raw('sum(de.cantidadCompra*precioCompraEgreso) as total'), 'u.nomUsuario', 'e.estadoEgreso')
            ->join('proveedor as p', 'e.idProveedor', '=', 'p.idProveedor')
            ->join('detalle_egreso as de', 'e.idEgreso', '=', 'de.idEgreso')
            ->join('tipo_comprobante as tc', 'e.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('tipopago as tp', 'e.idTipoPago', '=', 'tp.idTipoPago')
            ->join('usuario as u', 'e.idUsuario', '=', 'u.idUsuario')
            ->where('e.idEgreso', '=', $id)
            ->first();
        $detalle = DB::table('detalle_egreso as de')
            ->select('de.idProducto', 'pro.nomProducto', 'de.cantidadCompra', 'de.precioCompraEgreso', DB::raw('de.cantidadCompra*precioCompraEgreso as subtotal'))
            ->join('producto as pro', 'de.idProducto', '=', 'pro.idProducto')
            ->join('egresos as e', 'e.idEgreso', '=', 'de.idEgreso')
            ->where('de.idEgreso', '=', $id)
            ->groupBy('de.idProducto')
            ->get();
        $infoNego = DB::table('info_negocio')->first();
        $formatter = new NumeroALetras();
        $literal = $formatter->toInvoice($egreso->total, 2, 'BOLIVIANOS');
        //dd($literal);

        $pdf = Pdf::setPaper([0, 0, 226.77, 2267.72])->loadView('comercial.compra.reporte.compra-pdf', ['egreso' => $egreso, 'detalle' => $detalle, 'infoNego' => $infoNego, 'literal' => $literal]);

        return $pdf->stream();

    }
    public function create(Request $request)
    {
        $proveedor = DB::table('proveedor')->where('condicionProveedor', '=', '1')->get();
        $tipopago = DB::table('tipopago')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->get();
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

        return view('comercial/compra/create', ['proveedor' => $proveedor, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);

    }

    public function edit($id)
    {
        //dd('aki estamos',$id);

        /* $egreso=Egreso::findOrFail($id);
        $categoria=DB::table('categoria')->where('condicionCategoria','=','1')->get(); */
        //dd($producto);
        return view('comercial/compra/create');

        /* return  response()->json([
    "data"=> $producto,
    "cate"=>$categoria
    ]); */
    }
    public function store(Request $request)
    {
        //dd($request->detallecompra);
        $insertCompra = DB::table('egresos')
            ->insertGetId([
                'idProveedor' => $request->idProveedor,
                'idTipoPago' => $request->idTipoPago,
                'idTipoComprobante' => $request->idTipoComprobante,
                'numeroComprobante' => $request->numeroComprobante,
                'fechaEgreso' => $request->fechaEgreso,
                'impuestoEgreso' => $request->impuestoEgreso,
                'estadoEgreso' => $request->estadoEgreso,
                'idUsuario' => $request->idUsuario,
            ]);

        foreach ($request->detallecompra as $key => $value) {
            /* dump($value['idProducto']); */
            $insertDetalleCompra = DB::table('detalle_egreso')
                ->insertGetId([
                    'idEgreso' => $insertCompra,
                    'idProducto' => $value['idProducto'],
                    'cantidadCompra' => $value['cantidad'],
                    //'precioVentaEgreso' => 1,
                    'precioCompraEgreso' => $value['precio'],
                ]);

            $datos = [];
            for ($i = 1; $i <= $value['cantidad']; $i++) {
                //dump($i);
                //dd($value['cantidad']);
                array_push($datos, array(
                    'serie' => 'serie',
                    'idProducto' => $value['idProducto'],
                    'idDetalleEgreso' => $insertDetalleCompra,
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

        entrada_producto_almacen::insert($datos);

        return response()->json([
            "status" => 1,
            "message" => "GuarDado correctamnte",
            "data" => $insertCompra,
        ]);
    }
}
