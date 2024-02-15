<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Ingreso;
use App\Models\Cliente; //agrega la ruta del modelo
use App\Models\DetalleIngreso; //agrega la ruta del modelo
use Illuminate\Support\Facades\Redirect; //para hacer algunas redirecciones
use App\Http\Requests\IngresoFormRequest; //hace referencia a nuestro request
use DB;// sar la base de datos
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\IngresoController;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class IngresoController extends Controller
{
     public function __construct()
    {

    }
     public function index(Request $request) //recibe como parametro un objeto tipo request
    {

    	 if ($request->ajax()) {
            $query=trim($request->get('searchText'));
            $data = DB::table('ingresos as i')/* ->get() */
            ->join('cliente as c','i.idCliente','=','c.idCliente')
            ->join('detalle_ingreso as di','i.idIngreso','=','di.idIngreso')
            ->join('tipo_comprobante as tc','i.idTipoComprobante','=','tc.idTipoComprobante')
            ->join('tipopago as tp','i.idTipoPago','=','tp.idTipoPago')
            ->select('i.idIngreso','i.fechaIngreso','c.nomCliente','tc.nomTipoComprobante','i.numeroComprobante','i.impuestoIngreso','tp.nomTipoPago',DB::raw('sum(di.cantidadVenta*precioVenta) as total'),'i.estadoIngreso')
            ->where('i.numeroComprobante','LIKE','%'.$query.'%')

            ->groupBy('i.idIngreso','i.fechaIngreso','c.nomCliente','tc.nomTipoComprobante','i.numeroComprobante','i.impuestoIngreso','tp.nomTipoPago','i.estadoIngreso')
            ->get();
          /*   dd($data,"HOLAAA"); */
             /* return view('comercial.compra.index',compact('data')); */
            return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);


            }

            return view('comercial/venta/index');

    }
     public function create(Request $request)
    {
        $cliente=DB::table('cliente')->where('condicionCliente','=','1')->get();
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

        return view('comercial/venta/create',['cliente'=>$cliente,'tipopago'=>$tipopago,'tipo_comprobante'=>$tipo_comprobante]);

    }
}
