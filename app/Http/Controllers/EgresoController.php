<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Egreso;
use App\Models\Proveedor; //agrega la ruta del modelo
use App\Models\DetalleEgreso; //agrega la ruta del modelo
use Illuminate\Support\Facades\Redirect; //para hacer algunas redirecciones
use App\Http\Requests\EgresoFormRequest; //hace referencia a nuestro request
use DB;// sar la base de datos
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\EgresoController;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class EgresoController extends Controller
{
     public function __construct()
    {

    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {

    	 if ($request->ajax()) {
            $query=trim($request->get('searchText'));
            $data = DB::table('egresos as e')/* ->get() */
            ->join('proveedor as p','e.idProveedor','=','p.idProveedor')
            ->join('detalle_egreso as de','e.idEgreso','=','de.idEgreso')
            ->join('tipo_comprobante as tc','e.idTipoComprobante','=','tc.idTipoComprobante')
            ->join('tipopago as tp','e.idTipoPago','=','tp.idTipoPago')
            ->select('e.idEgreso','e.fechaEgreso','p.nomProveedor','tc.nomTipoComprobante','e.numeroComprobante','e.impuestoEgreso','tp.nomTipoPago',DB::raw('sum(de.cantidadCompra*precioCompraEgreso) as total'),'e.estadoEgreso')
            ->where('e.numeroComprobante','LIKE','%'.$query.'%')

            ->groupBy('e.idEgreso','e.fechaEgreso','p.nomProveedor','tc.nomTipoComprobante','e.numeroComprobante','e.impuestoEgreso','tp.nomTipoPago','e.estadoEgreso')
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
        $proveedor=DB::table('proveedor')->where('condicionProveedor','=','1')->get();
        $tipopago=DB::table('tipopago')->get();
        $tipo_comprobante=DB::table('tipo_comprobante')->get();
        if ($request->ajax()) {
            $data = DB::table('producto')
            ->where('condicionProducto','=','1')
            ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);

            }

        return view('comercial/compra/create',['proveedor'=>$proveedor,'tipopago'=>$tipopago,'tipo_comprobante'=>$tipo_comprobante]);

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
        /* dump($request->all()); */
        $insertCompra=DB::table('egresos')
        ->insertGetId([
            'idProveedor'=>$request->idProveedor,
            'idTipoPago'=>$request->idTipoPago,
            'idTipoComprobante'=>$request->idTipoComprobante,
            'numeroComprobante'=>$request->numeroComprobante,
            'fechaEgreso'=>date('Y-m-d'),
            'impuestoEgreso'=>$request->impuestoEgreso,
            'estadoEgreso'=>$request->estadoEgreso,
        ]);
        foreach ($request->detallecompra as $key => $value) {
            /* dump($value['idProducto']); */
            $insertDetalleCompra=DB::table('detalle_egreso')
            ->insertGetId([
                'idEgreso'=>$insertCompra,
                'idProducto'=>$value['idProducto'],
                'cantidadCompra'=>$value['cantidad'],
                'precioVentaEgreso'=>1,
                'precioCompraEgreso'=>$value['precio'],
            ]);
        }

        return  response()->json([
    		"status"=> 1,
			"message"=>"GuarDado correctamnte",
            "data"=>null
    	]);
    }
}
