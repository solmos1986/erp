<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Egreso; //agrega la ruta del modelo
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
        $this->middleware('auth');
    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
        //dd(auth()->user()->obtener_usuario());
    	 if ($request->ajax()) {
            $query=trim($request->get('searchText'));
            $data = DB::table('egresos as e')/* ->get() */
            ->join('proveedor as p','e.idProveedor','=','p.idProveedor')
            ->join('detalle_egreso as de','e.idEgreso','=','de.idEgreso')
            ->select('e.idEgreso','e.fechaEgreso','p.nomProveedor','e.tipoComprobante','e.numeroComprobante','e.impuestoEgreso','e.metodoPago',DB::raw('sum(de.cantidadEgreso*precioCompraEgreso) as total'),'e.estadoEgreso')
            ->where('e.numeroComprobante','LIKE','%'.$query.'%')

            ->groupBy('e.idEgreso','e.fechaEgreso','p.nomProveedor','e.tipoComprobante','e.numeroComprobante','e.impuestoEgreso','e.metodoPago','e.estadoEgreso')
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
        if ($request->ajax()) {
            $data = DB::table('producto')
            ->where('condicionProducto','=','1')
            ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
            }
        return view('comercial/compra/create');

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
}
