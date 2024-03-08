<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EgresoController;
use App\Models\DetalleEgreso; //agrega la ruta del modelo
use App\Models\Egreso; //agrega la ruta del modelo
use App\Models\entrada_producto_almacen; //para hacer algunas redirecciones
use App\Models\Proveedor; //hace referencia a nuestro request
use DB; // sar la base de datos
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EgresoController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {

        if ($request->ajax()) {
            $query = trim($request->get('searchText'));
            $data = DB::table('egresos as e') /* ->get() */
                ->join('proveedor as p', 'e.idProveedor', '=', 'p.idProveedor')
                ->join('detalle_egreso as de', 'e.idEgreso', '=', 'de.idEgreso')
                ->join('tipo_comprobante as tc', 'e.idTipoComprobante', '=', 'tc.idTipoComprobante')
                ->join('tipopago as tp', 'e.idTipoPago', '=', 'tp.idTipoPago')
                ->join('usuario as u', 'e.idUsuario', '=', 'u.idUsuario')
                ->select('e.idEgreso', 'e.fechaEgreso', 'p.nomProveedor', 'tc.nomTipoComprobante', 'e.numeroComprobante', 'e.impuestoEgreso', 'tp.nomTipoPago', DB::raw('sum(de.cantidadCompra*precioCompraEgreso) as total'), 'u.nomUsuario', 'e.estadoEgreso')
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

        return view('comercial/compra/index');

    }
    public function create(Request $request)
    {
        $proveedor = DB::table('proveedor')->where('condicionProveedor', '=', '1')->get();
        $tipopago = DB::table('tipopago')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->get();
        if ($request->ajax()) {
            $data = DB::table('producto')
                ->where('condicionProducto', '=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }

        return view('comercial/compra/create', ['proveedor' => $proveedor, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante]);

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
            "data" => null,
        ]);
    }
}
